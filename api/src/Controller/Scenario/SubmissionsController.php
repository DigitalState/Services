<?php

namespace App\Controller\Scenario;

use ApiPlatform\Core\Bridge\Symfony\Validator\Exception\ValidationException;
use App\Entity\Submission;
use App\Service\ScenarioService;
use App\Service\SubmissionService;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use function GuzzleHttp\json_decode;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SubmissionsController
 */
final class SubmissionsController
{
    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    private $requestStack;

    /**
     * @var \App\Service\ScenarioService
     */
    private $scenarioService;

    /**
     * @var \App\Service\SubmissionService
     */
    private $submissionService;

    /**
     * @var \Symfony\Component\Serializer\SerializerInterface
     */
    private $serializer;

    /**
     * Constructor
     *
     * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
     * @param \App\Service\ScenarioService $scenarioService
     * @param \App\Service\SubmissionService $submissionService
     * @param \Symfony\Component\Serializer\SerializerInterface $serializer
     */
    public function __construct(RequestStack $requestStack, ScenarioService $scenarioService, SubmissionService $submissionService, SerializerInterface $serializer)
    {
        $this->requestStack = $requestStack;
        $this->scenarioService = $scenarioService;
        $this->submissionService = $submissionService;
        $this->serializer = $serializer;
    }

    /**
     * Form
     *
     * @Route(path="/scenarios/{uuid}/submissions", methods={"POST"})
     * @param string $uuid
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function post($uuid)
    {
        $scenario = $this->scenarioService->getRepository()->findOneBy(['uuid' => $uuid]);

        if (!$scenario) {
            throw new NotFoundHttpException('Scenario not found.');
        }

        $request = $this->requestStack->getCurrentRequest();

        try {
            $content = json_decode($request->getContent());
        } catch (InvalidArgumentException $exception) {
            throw new BadRequestHttpException('Request content is not valid json.');
        }

        $submission = $this->submissionService->createInstance();
        $submission
            ->setScenario($scenario)
            ->setData((array) $content->data)
            ->setState(Submission::STATE_SUBMITTED);
        $violations = [];

        if (!$this->submissionService->isValid($submission, $violations)) {
            $list = new ConstraintViolationList($violations);
            throw new ValidationException($list, 'An error occurred');
        }

        $manager = $this->submissionService->getManager();
        $manager->persist($submission);
        $manager->flush();
        $response = new Response(
            $this->serializer->serialize($submission, 'json', ['item_operation_name' => 'get']),
            Response::HTTP_CREATED,
            ['Content-Type' => 'application/json']
        );

        return $response;
    }
}
