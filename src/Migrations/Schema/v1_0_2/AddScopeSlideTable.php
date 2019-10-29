<?php


namespace SliderBundle\Migrations\Schema\v1_0_2;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AddScopeSlideTable implements Migration
{

    /**
     * Modifies the given schema to apply necessary changes of a database
     * The given query bag can be used to apply additional SQL queries before and after schema changes
     *
     * @param Schema $schema
     * @param QueryBag $queries
     * @return void
     * @throws SchemaException
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->createSlideScopeTable($schema);

        /** Foreign keys generation **/
        $this->addSlideScopeForeignKeys($schema);
    }

    /**
     * Create `kiboko_slide_scope` table
     *
     * @param Schema $schema
     */
    protected function createSlideScopeTable(Schema $schema)
    {
        $table = $schema->createTable('kiboko_slide_scope');
        $table->addColumn('slide_id', 'integer', []);
        $table->addColumn('scope_id', 'integer', []);
        $table->setPrimaryKey(['slide_id', 'scope_id']);
    }

    /**
     * Add `kiboko_slide_scope` foreign keys.
     *
     * @param Schema $schema
     * @throws SchemaException
     */
    protected function addSlideScopeForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('kiboko_slide_scope');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_scope'),
            ['scope_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'CASCADE']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('kiboko_slider_slide'),
            ['slide_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'CASCADE']
        );
    }
}