<?php

namespace Ds\Component\BpmCamunda\Bridge\Symfony\Bundle\DependencyInjection;

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
        $treeBuilder = new TreeBuilder;
        $rootNode = $treeBuilder->root('ds_bpm_camunda');

        $rootNode
            ->children()
                ->arrayNode('host')
                    ->children()
                        ->scalarNode('url')
                        ->end()
                        ->scalarNode('user')
                        ->end()
                        ->scalarNode('password')
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
