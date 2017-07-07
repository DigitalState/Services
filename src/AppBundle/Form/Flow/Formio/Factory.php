<?php

namespace AppBundle\Form\Flow\Formio;

use AppBundle\Form\Flow\FormioFlow;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Factory
 */
class Factory
{
    /**
     * @var \AppBundle\Form\Flow\FormioFlow
     */
    protected $formioFlow;

    /**
     * Constructor
     *
     * @param \AppBundle\Form\Flow\FormioFlow $formioFlow
     */
    public function __construct(FormioFlow $formioFlow)
    {
        $this->formioFlow = $formioFlow;
    }

    /**
     * Create formio form flow
     *
     * @param string $slug
     * @return \AppBundle\Form\Flow\FormioFlow
     */
    public function create($slug)
    {
        $locator = new FileLocator(__DIR__.'/../../../Resources/config/flows');
        $file = $locator->locate($slug.'.yml');
        $config = Yaml::parse(file_get_contents($file));

        $name = $config['flow']['name'];
        $options = [];

        if (array_key_exists('allow_dynamic_step_navigation', $config['flow'])) {
            $options['allowDynamicStepNavigation'] = $config['flow']['allow_dynamic_step_navigation'];
        }

        $stepsConfig = [];

        foreach ($config['flow']['steps'] as $step) {
            $stepConfig = [];

            if (array_key_exists('label', $step)) {
                $stepConfig['label'] = $step['label'];
            }

            $stepConfig['form_type'] = 'AppBundle\Form\Type\FormioType';
            $stepConfig['form_options'] = [];

            if (array_key_exists('object', $step)) {
                $stepConfig['form_options']['name'] = $step['object'];
            }

            $stepConfig['form_options']['schema'] = json_decode(file_get_contents($config['formio']['host'].$step['formio']));

            if (array_key_exists('skip', $step)) {
                $stepConfig['skip'] = $step['skip'];
            }

            $stepsConfig[] = $stepConfig;
        }

        $flow = clone $this->formioFlow;
        $flow
            ->setName($name)
            ->setOptions($options)
            ->setStepsConfig($stepsConfig);

        return $flow;
    }
}