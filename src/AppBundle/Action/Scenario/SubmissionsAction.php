<?php

namespace AppBundle\Action\Scenario;

use ApiPlatform\Core\Bridge\Symfony\Validator\Exception\ValidationException;
use AppBundle\Entity\Submission;
use AppBundle\Service\ScenarioService;
use AppBundle\Service\SubmissionService;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\ConstraintViolationList;
use function GuzzleHttp\json_decode;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SubmissionsAction
 */
class SubmissionsAction
{
    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    protected $requestStack;

    /**
     * @var \AppBundle\Service\ScenarioService
     */
    protected $scenarioService;

    /**
     * @var \AppBundle\Service\SubmissionService
     */
    protected $submissionService;

    /**
     * Constructor
     *
     * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
     * @param \AppBundle\Service\ScenarioService $scenarioService
     * @param \AppBundle\Service\SubmissionService $submissionService
     */
    public function __construct(RequestStack $requestStack, ScenarioService $scenarioService, SubmissionService $submissionService)
    {
        $this->requestStack = $requestStack;
        $this->scenarioService = $scenarioService;
        $this->submissionService = $submissionService;
    }

    /**
     * Form
     *
     * @Method("POST")
     * @Route(path="/scenarios/{uuid}/submissions")
     * @param string $uuid
     * @return \Symfony\Component\HttpFoundation\JsonResponse
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
            ->setData($content->data)
            ->setState(Submission::STATE_SUBMITTED);
        $violations = [];

        if (!$this->submissionService->isValid($submission, $violations)) {
            $list = new ConstraintViolationList($violations);
            throw new ValidationException($list, 'An error occurred');
        }

        $manager = $this->submissionService->getManager();
        $manager->persist($submission);
        $manager->flush();
        $response = new JsonResponse($submission, Response::HTTP_CREATED);

        return $response;
    }
}
