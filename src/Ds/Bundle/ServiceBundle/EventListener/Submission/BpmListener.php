<?php

namespace Ds\Bundle\ServiceBundle\EventListener\Submission;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Ds\Bundle\ServiceBundle\Entity\Submission;
use Ds\Bundle\ServiceBundle\Entity\Scenario;
use Ds\Component\Bpm\Query\ProcessDefinitionParameters;

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
     * @var \Ds\Bundle\BpmBundle\Bpm\Api\Factory
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
     * Post persist
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Submission $submission
     */
    public function postPersist(Submission $submission)
    {
        // Circular reference error workaround
        $this->factory = $this->container->get('ds_bpm.bpm.api.factory');
        //

        $scenario = $submission->getScenario();
        $service = $scenario->getService();

        if (Scenario::TYPE_BPM !== $scenario->getType()) {
            return;
        }

        $bpm = $scenario->getData('bpm');
        $api = $this->factory->api($bpm);
        $bpmId = $scenario->getData('bpm_id');
        $form = $api->processDefinition->getStartForm($bpmId);

        $parameters = new ProcessDefinitionParameters;
        $parameters->setVariables([
            'api_url' => '',
            'api_user' => '',
            'api_key' => '',
            'service_uuid' => $service->getUuid(),
            'scenario_uuid' => $scenario->getUuid(),
            'identity' => $submission->getIdentity(),
            'identity_uuid' => $submission->getIdentityUuid(),
            'submission_uuid' => $submission->getUuid(),
            'none_start_event_form_data' => $submission->getData()
        ]);
        $api->processDefinition->start($bpmId, $parameters);
    }
}
