<?php

namespace SliderBundle\Migrations\Schema\v1_0_3;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AlterSliderTable implements Migration
{
    /**
     * @param Schema $schema
     * @param QueryBag $queries
     * @return void
     * @throws SchemaException
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->alterKibokoSliderSlide($schema);
        $this->alterKibokoSlider($schema);
    }

    public function alterKibokoSliderSlide(Schema $schema) {
        $table = $schema->getTable('kiboko_slider_slide');

        $table->removeForeignKey('FK_F33E6B592CCC9638'); // slider_id
        $table->addForeignKeyConstraint(
            $schema->getTable('kiboko_slider'),
            ['slider_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );

        $table->removeForeignKey('FK_F33E6B5932C8A3DE'); // organization_id
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_organization'),
            ['organization_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
        $table->changeColumn('organization_id', ['notnull' => false]);

        $table->addColumn('serialized_data', 'text', ['default' => null, 'comment' => '(DC2Type:array)']);
    }

    public function alterKibokoSlider(Schema $schema) {
        $table = $schema->getTable('kiboko_slider');

        $table->removeForeignKey('FK_784807632C8A3DE'); // organization_id
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_organization'),
            ['organization_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
        $table->changeColumn('organization_id', ['notnull' => false]);
    }
}