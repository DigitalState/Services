<?php

namespace Ds\Bundle\BpmBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('ds_bpm');

        $rootNode
            ->children()
                ->arrayNode('variables')
                    ->children()
                        ->scalarNode('api_url')
                        ->end()
                        ->scalarNode('api_user')
                        ->end()
                        ->scalarNode('api_key')
                        ->end()
                        ->scalarNode('service')
                        ->end()
                        ->scalarNode('scenario')
                        ->end()
                        ->scalarNode('user')
                        ->end()
                        ->scalarNode('none_start_event_form_data')
                        ->end()
                        ->scalarNode('localization')
                        ->end()
                        ->scalarNode('user_task_form_data')
                        ->end()
                        ->scalarNode('error')
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
