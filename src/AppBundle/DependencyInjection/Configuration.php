<?php

namespace AppBundle\DependencyInjection;

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
        $builder = new TreeBuilder;
        $node = $builder->root('app');

        $node
            ->children()
                ->arrayNode('services')
                    ->children()
                        ->arrayNode('formio')
                            ->children()
                                ->scalarNode('url')
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('camunda')
                            ->children()
                                ->scalarNode('url')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $builder;
    }
}
