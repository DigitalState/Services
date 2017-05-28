<?php

namespace Ds\Bundle\BpmBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Ds\Bundle\BpmBundle\DependencyInjection\DsBpmExtension;

/**
 * Class ConfigPass
 */
class ConfigPass implements CompilerPassInterface
{
    /**
     * Process
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('ds_config.collection.config')) {
            return;
        }

        $definition = $container->findDefinition('ds_config.collection.config');

        foreach (DsBpmExtension::getVariables() as $variable) {
            $variable = 'ds_bpm.variables.'.$variable;
            $definition->addMethodCall('set', [$variable, $container->getParameter($variable)]);
        }
    }
}
