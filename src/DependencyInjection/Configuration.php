<?php

namespace CoinhiveBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('coinhive');

        $rootNode
            ->children()
            ->arrayNode('config')
            ->children()
            ->scalarNode('site_key')->end()
            ->end()
            ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
