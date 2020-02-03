<?php

namespace SliderBundle\Migrations\Schema\v1_0_4;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AlterSliderTable implements Migration
{
    /**
     * @param Schema $schema
     * @param QueryBag $queries
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->alterKibokoSliderSlide($schema);
    }

    public function alterKibokoSliderSlide(Schema $schema)
    {
        $table = $schema->getTable('kiboko_slider_slide');
        $table->changeColumn('url', ['notnull' => false]);
        $table->changeColumn('button', ['notnull' => false]);
        $table->changeColumn('description', ['notnull' => false]);
        $table->changeColumn('started_at', ['notnull' => false]);
        $table->changeColumn('expired_at', ['notnull' => false]);
    }
}
