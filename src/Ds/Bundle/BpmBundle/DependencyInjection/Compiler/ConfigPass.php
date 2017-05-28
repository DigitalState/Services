<?php

namespace Ds\Bundle\BpmBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

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

        $variables = [
            'api_url', 'api_user', 'api_key', 'service', 'scenario', 'user', 'submission',
            'none_start_event_form_data', 'localization', 'user_task_form_data'
        ];

        foreach ($variables as $variable) {
            $variable = 'ds_bpm.variables.'.$variable;
            $definition->addMethodCall('set', [$variable, $container->getParameter($variable)]);
        }
    }
}
