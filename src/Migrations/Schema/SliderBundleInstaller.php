<?php

namespace SliderBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\AttachmentBundle\Migration\Extension\AttachmentExtension;
use Oro\Bundle\AttachmentBundle\Migration\Extension\AttachmentExtensionAwareInterface;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class SliderBundleInstaller implements Installation, AttachmentExtensionAwareInterface
{
    /** @var AttachmentExtension */
    private $attachmentExtension;

    public function setAttachmentExtension(AttachmentExtension $attachmentExtension)
    {
        $this->attachmentExtension = $attachmentExtension;
    }

    /**
     * {@inheritdoc}
     */
    public function getMigrationVersion()
    {
        return 'v1_0_2';
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->createSliderTable($schema);
        $this->addSliderForeignKeys($schema);

        $this->createSlideTable($schema);
        $this->addSlideForeignKeys($schema);
    }

    /** Slider **/
    protected function createSliderTable(Schema $schema)
    {
        $table = $schema->createTable('kiboko_slider');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('code', 'string', ['length' => 255]);
        $table->addColumn('name', 'string', ['length' => 255]);
        $table->addColumn('created_at', 'datetime', ['comment' => '(DC2Type:datetime)']);
        $table->addColumn('updated_at', 'datetime', ['comment' => '(DC2Type:datetime)']);
        $table->addColumn('organization_id', 'integer', []);
        $table->setPrimaryKey(['id']);

        $table->addIndex(['organization_id'], 'idx_organisation_slider', []);
    }

    protected function addSliderForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('kiboko_slider');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_organization'),
            ['organization_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => null]
        );
    }

    /** Slide **/
    protected function createSlideTable(Schema $schema)
    {
        $table = $schema->createTable('kiboko_slider_slide');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('enabled', 'boolean', ['default' => true]);
        $table->addColumn('slider_id', 'integer', ['notnull' => false]);
        $table->addColumn('sort_order', 'string', ['length' => 255]);
        $table->addColumn('name', 'string', ['length' => 255]);
        $table->addColumn('url', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('button', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('description', 'text', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', ['comment' => '(DC2Type:datetime)']);
        $table->addColumn('updated_at', 'datetime', ['comment' => '(DC2Type:datetime)']);
        $table->addColumn('started_at', 'datetime', ['notnull' => false, 'comment' => '(DC2Type:datetime)']);
        $table->addColumn('expired_at', 'datetime', ['notnull' => false, 'comment' => '(DC2Type:datetime)']);
        $table->addColumn('organization_id', 'integer', []);
        $this->attachmentExtension->addImageRelation(
            $schema,
            'kiboko_slider_slide',
            'picture',
            [],
            7,
            100,
            100
        );
        $table->setPrimaryKey(['id']);

        $table->addIndex(['slider_id'], 'idx_slider_slide', []);
        $table->addIndex(['organization_id'], 'idx_organisation_slide', []);
    }

    protected function addSlideForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('kiboko_slider_slide');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_organization'),
            ['organization_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('kiboko_slider'),
            ['slider_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => null]
        );
    }
}
