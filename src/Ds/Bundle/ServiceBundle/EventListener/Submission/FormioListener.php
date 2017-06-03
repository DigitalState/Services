<?php

namespace Ds\Bundle\ServiceBundle\EventListener\Submission;

use Ds\Component\Formio\Api\Api;
use ApiPlatform\Core\Hydra\Serializer\ConstraintViolationListNormalizer;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Ds\Bundle\ServiceBundle\Entity\Submission;
use Ds\Component\Formio\Model\Submission as Model;
use Ds\Component\Formio\Query\SubmissionParameters as Parameters;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Exception;


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
     * @var \ApiPlatform\Core\Hydra\Serializer\ConstraintViolationListNormalizer
     */
    protected $normalizer;

    /**
     * Constructor
     *
     * @param \Ds\Component\Formio\Api\Api $api
     * @param \ApiPlatform\Core\Hydra\Serializer\ConstraintViolationListNormalizer $normalizer
     */
    public function __construct(Api $api, ConstraintViolationListNormalizer $normalizer)
    {
        $this->api = $api;
        $this->normalizer = $normalizer;
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
        $model = new Model;
        $model->setData((object) $submission->getData());
        $parameters = new Parameters;
        $parameters->setDryRun(true);

        try {
            $this->api->submission->create($model, $parameters);
        } catch (Exception $exception) {
            // @todo Parse formio errors and normalize them using api platform standards
            $response = new JsonResponse(['error' => 'Data is not valid.'], Response::HTTP_BAD_REQUEST);
            $event->setResponse($response);
        }
    }
}
