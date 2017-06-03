<?php

namespace Ds\Bundle\ServiceBundle\EventListener\Submission;

use Ds\Component\Formio\Api\Api;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Ds\Bundle\ServiceBundle\Entity\Submission;

/**
 * Class FormioListener
 */
class FormioListener
{
    /**
     * @var \Ds\Component\Formio\Api\Api
     */
    protected $api;

    /**
     * Constructor
     *
     * @param \Ds\Component\Formio\Api\Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * Validate submission using formio dryrun
     *
     * @param \Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent $event
     */
    public function kernelView(GetResponseForControllerResultEvent $event)
    {
        $entity = $event->getControllerResult();

        if (!$entity instanceof Submission) {
            return;
        }

        $submission = $entity;
    }
}
