<?php

namespace Ds\Component\Bpm\Bridge\Symfony\Bundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ApiPass
 */
class ApiPass implements CompilerPassInterface
{
    /**
     * Process
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('ds_bpm.collection.api')) {
            return;
        }

        $definition = $container->findDefinition('ds_bpm.collection.api');
        $services = $container->findTaggedServiceIds('ds_bpm.api');

        foreach ($services as $id => $tags) {
            foreach ($tags as $tag) {
                $alias = array_key_exists('alias', $tag) ? $tag['alias'] : null;
                $definition->addMethodCall('set', [$alias, new Reference($id)]);
            }
        }
    }
}
