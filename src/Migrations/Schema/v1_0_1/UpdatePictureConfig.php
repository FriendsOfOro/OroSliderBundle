<?php


namespace SliderBundle\Migrations\Schema;


use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityConfigBundle\Migration\UpdateEntityConfigFieldValueQuery;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;
use Oro\Bundle\OrganizationBundle\Entity\BusinessUnit;
use Oro\Bundle\WebCatalogBundle\Entity\ContentNode;
use SliderBundle\Entity\Slide;

class UpdatePictureConfig implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $queries->addPostQuery(
            new UpdateEntityConfigFieldValueQuery(Slide::class, 'picture', 'attachment', 'acl_protected', false)
        );
    }
}