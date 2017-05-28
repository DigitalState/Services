<?php

namespace Ds\Bundle\BpmBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

/**
 * Class DsBpmExtension
 */
class DsBpmExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig('ds_bpm', [
            'variables' => [
                'api_url' => '_api_url',
                'api_user' => '_api_user',
                'api_key' => '_api_key',
                'service' => '_service',
                'scenario' => '_scenario',
                'user' => '_user',
                'submission' => '_submission',
                'none_start_event_form_data' => '_none_start_event_form_data',
                'localization' => '_localization',
                'user_task_form_data' => '_user_task_{id}_form_data',
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration;
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
