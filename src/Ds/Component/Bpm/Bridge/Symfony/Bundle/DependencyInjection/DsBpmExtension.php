<?php

namespace Ds\Component\Bpm\Bridge\Symfony\Bundle\DependencyInjection;

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
        $loader->load('parameters.yml');
        $loader->load('api.yml');
        $loader->load('collections.yml');
        $loader->load('resolvers.yml');
        $loader->load('services.yml');

        // @todo Move this config -> parameters logic to a common trait in the config component bridge
        $container->setParameter('ds_config.configs.ds_bpm.variables.api_url', $config['variables']['api_url']);
        $container->setParameter('ds_config.configs.ds_bpm.variables.api_user', $config['variables']['api_user']);
        $container->setParameter('ds_config.configs.ds_bpm.variables.api_key', $config['variables']['api_key']);
        $container->setParameter('ds_config.configs.ds_bpm.variables.service_uuid', $config['variables']['service_uuid']);
        $container->setParameter('ds_config.configs.ds_bpm.variables.scenario_uuid', $config['variables']['scenario_uuid']);
        $container->setParameter('ds_config.configs.ds_bpm.variables.identity', $config['variables']['identity']);
        $container->setParameter('ds_config.configs.ds_bpm.variables.identity_uuid', $config['variables']['identity_uuid']);
        $container->setParameter('ds_config.configs.ds_bpm.variables.submission_uuid', $config['variables']['submission_uuid']);
        $container->setParameter('ds_config.configs.ds_bpm.variables.none_start_event_form_data', $config['variables']['none_start_event_form_data']);
        $container->setParameter('ds_config.configs.ds_bpm.variables.localization', $config['variables']['localization']);
        $container->setParameter('ds_config.configs.ds_bpm.variables.user_task_form_data', $config['variables']['user_task_form_data']);
        $container->setParameter('ds_config.configs.ds_bpm.variables.error', $config['variables']['error']);
    }
}
