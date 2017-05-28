<?php

namespace Ds\Bundle\ServiceBundle\EventListener\Submission;

use Ds\Bundle\BpmBundle\Bpm\Api\Factory;
use Ds\Bundle\ServiceBundle\Entity\Submission;
use Ds\Bundle\ServiceBundle\Entity\Scenario;

/**
 * Class BpmListener
 */
class BpmListener
{
    /**
     * @var \Ds\Bundle\BpmBundle\Bpm\Api\Factory
     */
    protected $factory;

    /**
     * Constructor
     *
     * @param \Ds\Bundle\BpmBundle\Bpm\Api\Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
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

        $bpm = $scenario->getData('bpm');
        $bpmId = $scenario->getData('bpm_id');
        $api = $this->factory->create($bpm);
        $api->processDefinition->start($bpmId);
    }
}
