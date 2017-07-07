<?php

namespace AppBundle\Action\Scenario;

use AppBundle\Service\ScenarioService;
use AppBundle\Service\SubmissionService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $content = json_decode($request->getContent(), true);
        $submission = $this->submissionService->createInstance();
        $submission
            ->setScenario($scenario)
            ->setData($content['data']);

        if (!$this->submissionService->isValid($submission)) {
            return new JsonResponse((object) ['error' => 'Data is not valid.']);
        }

        $this->submissionService->getManager()->persist($submission);
        $this->submissionService->getManager()->flush();

        return new JsonResponse($submission, Response::HTTP_CREATED);
    }
}
