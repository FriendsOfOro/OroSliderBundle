<?php


namespace SliderBundle\DependencyInjection;


use Oro\Bundle\ConfigBundle\DependencyInjection\SettingsBuilder;
use Oro\Bundle\CustomerBundle\DependencyInjection\OroCustomerExtension;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root(SliderExtension::ALIAS);

        SettingsBuilder::append(
            $rootNode,
                [
                    'use_cms_block' => ['type' => 'boolean', 'value' => false],
                    'slider_used' => ['type' => 'object', 'value' => null]
            ]
        );

        return $treeBuilder;
    }
}