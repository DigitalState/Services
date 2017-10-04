<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class AppExtension
 */
class AppExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig('app', [
            'bpm' => [
                'variables' => [
                    'api_url' => 'api_url',
                    'api_user' => 'api_user',
                    'api_key' => 'api_key',
                    'service_uuid' => 'service_uuid',
                    'scenario_uuid' => 'scenario_uuid',
                    'identity' => 'identity',
                    'identity_uuid' => 'identity_uuid',
                    'submission_uuid' => 'submission_uuid',
                    'start_data' => 'start_data'
                ]
            ]
        ]);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('config.yml');
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration;
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('actions.yml');
        $loader->load('api_filters.yml');
        $loader->load('event_listeners.yml');
        $loader->load('forms.yml');
        $loader->load('services.yml');
        $loader->load('stats.yml');

        // @todo Move this config -> parameters logic to a common trait in the config component bridge
        $container->setParameter('ds_config.configs.app.bpm.variables.api_url', $config['bpm']['variables']['api_url']);
        $container->setParameter('ds_config.configs.app.bpm.variables.api_user', $config['bpm']['variables']['api_user']);
        $container->setParameter('ds_config.configs.app.bpm.variables.api_key', $config['bpm']['variables']['api_key']);
        $container->setParameter('ds_config.configs.app.bpm.variables.service_uuid', $config['bpm']['variables']['service_uuid']);
        $container->setParameter('ds_config.configs.app.bpm.variables.scenario_uuid', $config['bpm']['variables']['scenario_uuid']);
        $container->setParameter('ds_config.configs.app.bpm.variables.identity', $config['bpm']['variables']['identity']);
        $container->setParameter('ds_config.configs.app.bpm.variables.identity_uuid', $config['bpm']['variables']['identity_uuid']);
        $container->setParameter('ds_config.configs.app.bpm.variables.submission_uuid', $config['bpm']['variables']['submission_uuid']);
        $container->setParameter('ds_config.configs.app.bpm.variables.start_data', $config['bpm']['variables']['start_data']);
    }
}
