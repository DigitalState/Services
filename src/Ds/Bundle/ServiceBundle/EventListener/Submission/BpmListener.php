<?php

namespace Ds\Bundle\ServiceBundle\EventListener\Submission;

use Behat\Mink\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Ds\Bundle\ServiceBundle\Entity\Submission;
use Ds\Bundle\ServiceBundle\Entity\Scenario;
use Ds\Component\Bpm\Query\ProcessDefinitionParameters;
use Ds\Component\Formio\Model\Submission as SubmissionModel;
use Ds\Component\Formio\Query\SubmissionParameters;

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
     * Constructor
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        // Circular reference error workaround
        $this->container = $container;
    }

    /**
     * Post persist
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Submission $submission
     */
    public function postPersist(Submission $submission)
    {
        $scenario = $submission->getScenario();

        if (Scenario::TYPE_BPM !== $scenario->getType()) {
            return;
        }

        $bpm = $this->container->get('ds_bpm.api.factory')->api($scenario->getData('bpm'));
        $formio = $this->container->get('ds_formio.api');

        // Bpm form key
        $form = $bpm->processDefinition->getStartForm($scenario->getData('bpm_id'));

        // Formio dryrun
        $model = new SubmissionModel;
        $model
            ->setData((object) $submission->getData());
        $parameters = new SubmissionParameters;
        $parameters
            ->setDryRun(true);
        $formio->submission->create($model, $parameters);

        // Bpm start instance
        $service = $scenario->getService();
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
        $bpm->processDefinition->start($scenario->getData('bpm_id'), $parameters);
    }
}
