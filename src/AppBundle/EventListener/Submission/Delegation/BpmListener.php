<?php

namespace AppBundle\EventListener\Submission\Delegation;

use AppBundle\Entity\Submission;
use AppBundle\Entity\Scenario;
use Ds\Component\Bpm\Model\Variable;
use Ds\Component\Bpm\Query\ProcessDefinitionParameters;
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
     * @var \Ds\Component\Bpm\Bridge\Symfony\Bundle\Api\Factory
     */
    protected $factory;

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
        $this->factory = $this->container->get('ds_bpm.api.factory');
        //

        $scenario = $submission->getScenario();

        if (Scenario::TYPE_BPM !== $scenario->getType()) {
            return;
        }

        $api = $this->factory->api($scenario->getData('bpm'));
        $service = $scenario->getService();
        $parameters = new ProcessDefinitionParameters;
        $parameters->addVariable(new Variable('api_url', ''));
        $parameters->addVariable(new Variable('api_user', ''));
        $parameters->addVariable(new Variable('api_key', ''));
        $parameters->addVariable(new Variable('service_uuid', $service->getUuid()));
        $parameters->addVariable(new Variable('scenario_uuid', $scenario->getUuid()));
        $parameters->addVariable(new Variable('identity', $submission->getIdentity()));
        $parameters->addVariable(new Variable('identity_uuid', $submission->getIdentityUuid()));
        $parameters->addVariable(new Variable('submission_uuid', $submission->getUuid()));
        $parameters->addVariable(new Variable('none_start_event_form_data', $submission->getData(), Variable::TYPE_JSON));
        $parameters->setKey($scenario->getData('process_definition_key'));
        $api->processDefinition->start(null, $parameters);
    }
}
