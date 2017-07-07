<?php

namespace AppBundle\EventListener\Submission\Validation;

use AppBundle\Service\SubmissionService;
use AppBundle\Entity\Submission;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

/**
 * Class DataListener
 */
class DataListener
{
    /**
     * @var \AppBundle\Service\SubmissionService
     */
    protected $submissionService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\SubmissionService $submissionService
     */
    public function __construct(SubmissionService $submissionService)
    {
        $this->submissionService = $submissionService;
    }

    /**
     * Validate the submission using the formio dryrun
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
