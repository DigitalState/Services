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
     * @var \Ds\Component\Api\Api\Factory
     */
    protected $factory;

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
        $this->factory = $this->container->get('ds_api.factory');
        $this->configService = $this->container->get('ds_config.service.config');
        $this->submissionService = $this->container->get('app.service.submission');
        //

        $scenario = $submission->getScenario();

        if (Scenario::TYPE_BPM !== $scenario->getType()) {
            return;
        }

        if (!$this->api) {
            $this->api = $this->factory->create();
        }

//        $parameters = new ProcessDefinitionParameters;
//        $parameters->setKey($scenario->getConfig('process_definition_key'));
//        $xml = $this->api->camunda->processDefinition->getXml(null, $parameters);
        $service = $scenario->getService();
        $parameters = new ProcessDefinitionParameters;
        $parameters
            ->setVariables([
                new Variable($this->configService->get('app.bpm.variables.api_url'), ''),
                new Variable($this->configService->get('app.bpm.variables.api_user'), ''),
                new Variable($this->configService->get('app.bpm.variables.api_key'), ''),
                new Variable($this->configService->get('app.bpm.variables.service_uuid'), $service->getUuid()),
                new Variable($this->configService->get('app.bpm.variables.scenario_uuid'), $scenario->getUuid()),
                new Variable($this->configService->get('app.bpm.variables.identity'), $submission->getIdentity()),
                new Variable($this->configService->get('app.bpm.variables.identity_uuid'), $submission->getIdentityUuid()),
                new Variable($this->configService->get('app.bpm.variables.submission_uuid'), $submission->getUuid()),
                new Variable($this->configService->get('app.bpm.variables.start_data'), $submission->getData(), Variable::TYPE_JSON)
            ])
            ->setKey($scenario->getConfig('process_definition_key'));
        $this->api->camunda->processDefinition->start(null, $parameters);
        $submission->setState(Submission::STATE_TRANSFERRED);
        $manager = $this->submissionService->getManager();
        $manager->persist($submission);
        $manager->flush();
    }
}
