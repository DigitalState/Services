<?php

namespace AppBundle\EventListener\Submission\Validation;

use ApiPlatform\Core\Bridge\Symfony\Validator\Exception\ValidationException;
use AppBundle\Service\SubmissionService;
use AppBundle\Entity\Submission;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Validator\ConstraintViolationList;

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
     * Validate the submission data using the formio dryrun
     *
     * @param \Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent $event
     */
    public function kernelView(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();

        if ($request->attributes->get('_api_resource_class') !== Submission::class) {
            return;
        }

        if ('post' !== $request->attributes->get('_api_collection_operation_name')) {
            return;
        }

        $submission = $event->getControllerResult();
        $violations = [];

        if (!$this->submissionService->isValid($submission, $violations)) {
            $list = new ConstraintViolationList($violations);
            throw new ValidationException($list, 'An error occurred');
        }
    }
}
