<?php

namespace Ds\Bundle\ServiceBundle\EventListener\Submission\Validation;

use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ds\Bundle\ServiceBundle\Service\SubmissionService;
use Ds\Bundle\ServiceBundle\Entity\Submission;

/**
 * Class DataListener
 */
class DataListener
{
    /**
     * @var \Ds\Bundle\ServiceBundle\Service\SubmissionService
     */
    protected $submissionService;

    /**
     * Constructor
     *
     * @param \Ds\Bundle\ServiceBundle\Service\SubmissionService $submissionService
     */
    public function __construct(SubmissionService $submissionService)
    {
        $this->submissionService = $submissionService;
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

        if (!$this->submissionService->isValid($submission)) {
            $response = new JsonResponse(['error' => 'Data is not valid.'], Response::HTTP_BAD_REQUEST);
            $event->setResponse($response);
        }
    }
}
