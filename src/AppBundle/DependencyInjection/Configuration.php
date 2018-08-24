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
                ->arrayNode('bpm')
                    ->children()
                        ->arrayNode('variables')
                            ->children()
                                ->scalarNode('api_url')->end()
                                ->scalarNode('api_user')->end()
                                ->scalarNode('api_key')->end()
                                ->scalarNode('service_uuid')->end()
                                ->scalarNode('scenario_uuid')->end()
                                ->scalarNode('identity')->end()
                                ->scalarNode('identity_uuid')->end()
                                ->scalarNode('submission_uuid')->end()
                                ->scalarNode('start_data')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $builder;
    }
}
