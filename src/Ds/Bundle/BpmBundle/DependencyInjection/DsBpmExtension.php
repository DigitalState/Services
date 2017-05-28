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
     * Get variables
     *
     * @return array
     */
    public static function getVariables()
    {
        return [
            'api_url', 'api_user', 'api_key', 'service_uuid', 'scenario_uuid',
            'identity', 'identity_uuid', 'submission_uuid', 'none_start_event_form_data',
            'localization', 'user_task_form_data'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $variables = [];

        foreach (static::getVariables() as $variable) {
            $variables[$variable] = '_'.$variable;
        }

        $container->prependExtensionConfig('ds_bpm', ['variables' => $variables]);
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

        foreach (static::getVariables() as $variable) {
            $container->setParameter('ds_bpm.variables.'.$variable, $config['variables'][$variable]);
        }
    }
}
