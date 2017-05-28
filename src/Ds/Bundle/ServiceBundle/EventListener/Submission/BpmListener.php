<?php

namespace Ds\Bundle\ServiceBundle\EventListener\Submission;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Ds\Bundle\BpmBundle\Bpm\Api\Factory;
use Ds\Bundle\ServiceBundle\Entity\Submission;
use Ds\Bundle\ServiceBundle\Entity\Scenario;

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
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
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
        $scenario = $submission->getScenario();

        if (Scenario::TYPE_BPM !== $scenario->getType()) {
            return;
        }

        // Circular reference error workaround
        $this->factory = $this->container->get('ds_bpm.bpm.api.factory');
        //

        $bpm = $scenario->getData('bpm');
        $bpmId = $scenario->getData('bpm_id');
        $api = $this->factory->create($bpm);
        $api->processDefinition->start($bpmId);
    }
}
