<?php

namespace AppBundle\EventListener\Submission\Transfer;

use AppBundle\Entity\Submission;
use AppBundle\Entity\Scenario;
use Ds\Component\Camunda\Model\Variable;
use Ds\Component\Camunda\Query\ProcessDefinitionParameters;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class BpmListener
 */
class BpmListener
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @var \Ds\Component\Api\Api\Api
     */
    protected $api;

    /**
     * @var \Ds\Component\Config\Service\ConfigService
     */
    protected $configService;

    /**
     * @var \Appbundle\Service\SubmissionService
     */
    protected $submissionService;

    /**
     * Constructor
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Forward the submission to the bpm service
     *
     * @param \AppBundle\Entity\Submission $submission
     */
    public function postPersist(Submission $submission)
    {
        // Circular reference error workaround
        // @todo Look into fixing this
        $this->api = $this->container->get('ds_api.api');
        $this->configService = $this->container->get('ds_config.service.config');
        $this->submissionService = $this->container->get('app.service.submission');
        //

        $scenario = $submission->getScenario();

        if (Scenario::TYPE_BPM !== $scenario->getType()) {
            return;
        }

//        $parameters = new ProcessDefinitionParameters;
//        $parameters->setKey($scenario->getConfig('process_definition_key'));
//        $xml = $this->api->camunda->processDefinition->getXml(null, $parameters);
        $service = $scenario->getService();
        $parameters = new ProcessDefinitionParameters;
        $variables = [];
        $variables[] = new Variable($this->configService->get('app.bpm.variables.api_url'), '');
        $variables[] = new Variable($this->configService->get('app.bpm.variables.api_user'), '');
        $variables[] = new Variable($this->configService->get('app.bpm.variables.api_key'), '');
        $variables[] = new Variable($this->configService->get('app.bpm.variables.service_uuid'), $service->getUuid());
        $variables[] = new Variable($this->configService->get('app.bpm.variables.scenario_uuid'), $scenario->getUuid());
        $config = $scenario->getConfig();

        if (array_key_exists('process_custom_data', $config)
            && array_key_exists('enabled', $config['process_custom_data'])
            && $config['process_custom_data']['enabled']
            && array_key_exists('value', $config['process_custom_data'])
        ) {
            $variables[] = new Variable($this->configService->get('app.bpm.variables.scenario_custom_data'), $config['process_custom_data']['value'], Variable::TYPE_JSON);
        }

        $variables[] = new Variable($this->configService->get('app.bpm.variables.identity'), $submission->getIdentity());
        $variables[] = new Variable($this->configService->get('app.bpm.variables.identity_uuid'), $submission->getIdentityUuid());
        $variables[] = new Variable($this->configService->get('app.bpm.variables.submission_uuid'), $submission->getUuid());
        $variables[] = new Variable($this->configService->get('app.bpm.variables.start_data'), $submission->getData(), Variable::TYPE_JSON);
        $parameters
            ->setVariables($variables)
            ->setKey($scenario->getConfig('process_definition_key'));
        $this->api->get('camunda.process_definition')->start(null, $parameters);
        $submission->setState(Submission::STATE_TRANSFERRED);
        $manager = $this->submissionService->getManager();
        $manager->persist($submission);
        $manager->flush();
    }
}
