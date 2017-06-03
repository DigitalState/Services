<?php

namespace Ds\Bundle\ServiceBundle\EventListener\Submission;

use Ds\Component\Formio\Api\Api;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Ds\Bundle\ServiceBundle\Entity\Submission;
use Ds\Component\Formio\Model\Submission as Model;
use Ds\Component\Formio\Query\SubmissionParameters as Parameters;


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

//        $submission = $entity;
//        $model = new Model;
//        $model
//            ->setData((object) $submission->getData());
//        $parameters = new Parameters;
//        $parameters
//            ->setDryRun(true);
//        $this->api->submission->create($model, $parameters);
    }
}
