<?php

namespace Ds\Bundle\ServiceBundle\EventListener\Submission\Validation;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Ds\Component\Formio\Api\Api;
use Ds\Component\Config\Service\ConfigService;
use ApiPlatform\Core\Hydra\Serializer\ConstraintViolationListNormalizer;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Ds\Bundle\ServiceBundle\Entity\Submission;
use Ds\Bundle\ServiceBundle\Entity\Scenario;
use Ds\Component\Formio\Model\Submission as Model;
use Ds\Component\Formio\Query\SubmissionParameters as Parameters;
use Ds\Component\Bpm\Query\ProcessDefinitionParameters;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ds\Component\Formio\Exception\ValidationException;


/**
 * Class FormioListener
 */
class FormioListener
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @var \Ds\Component\Bpm\Bridge\Symfony\Bundle\Api\Factory
     */
    protected $factory;

    /**
     * @var \Ds\Component\Formio\Api\Api
     */
    protected $api;

    /**
     * @var \Ds\Component\Config\Service\ConfigService
     */
    protected $configService;

    /**
     * @var \ApiPlatform\Core\Hydra\Serializer\ConstraintViolationListNormalizer
     */
    protected $normalizer;

    /**
     * Constructor
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     * @param \Ds\Component\Formio\Api\Api $api
     * @param \Ds\Component\Config\Service\ConfigService $configService
     * @param \ApiPlatform\Core\Hydra\Serializer\ConstraintViolationListNormalizer $normalizer
     */
    public function __construct(ContainerInterface $container, Api $api, ConfigService $configService, ConstraintViolationListNormalizer $normalizer)
    {
        $this->container = $container;
        $this->api = $api;
        $this->configService = $configService;
        $this->normalizer = $normalizer;
    }

    /**
     * Validate submission using formio dryrun
     *
     * @param \Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent $event
     */
    public function kernelView(GetResponseForControllerResultEvent $event)
    {
        // Circular reference error workaround
        // @todo Look into fixing this
        $this->factory = $this->container->get('ds_bpm.api.factory');
        //

        $entity = $event->getControllerResult();

        if (!$entity instanceof Submission) {
            return;
        }

        $submission = $entity;
        $form = $this->getForm($submission->getScenario());

        if (null === $form) {
            return;
        }

        list(,$form) = explode(':', $form, 2);

        $model = new Model;
        $model
            ->setForm($form)
            ->setData((object) $submission->getData());
        $parameters = new Parameters;
        $this->api->setHost($this->configService->get('ds_service.services.formio.url'));

        try {
            $this->api->submission->create($model, $parameters);
        } catch (ValidationException $exception) {
            // @todo Parse formio errors and normalize them using api platform standards
            $response = new JsonResponse(['error' => 'Data is not valid.'], Response::HTTP_BAD_REQUEST);
            $event->setResponse($response);
        }
    }

    /**
     * Get form
     *
     * @param Scenario $scenario
     * @return array
     */
    protected function getForm(Scenario $scenario)
    {
        $type = $scenario->getType();

        switch ($type) {
            case Scenario::TYPE_BPM:
                $api = $this->factory->api($scenario->getData('bpm'));
                $api->setHost($this->configService->get('ds_service.services.camunda.url'));
                $parameters = new ProcessDefinitionParameters;
                $parameters->setKey($scenario->getData('process_definition_key'));
                $form = $api->processDefinition->getStartForm(null, $parameters);

                break;

            default:
                $form = null;
        }

        return $form;
    }
}
