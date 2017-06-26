<?php

namespace Ds\Bundle\ServiceBundle\Action\Scenario;

use Symfony\Component\HttpFoundation\RequestStack;
use Ds\Bundle\ServiceBundle\Service\ScenarioService;
use Ds\Bundle\ServiceBundle\Service\SubmissionService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
     * @var \Ds\Bundle\ServiceBundle\Service\ScenarioService
     */
    protected $scenarioService;

    /**
     * @var \Ds\Bundle\ServiceBundle\Service\SubmissionService
     */
    protected $submissionService;

    /**
     * Constructor
     *
     * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
     * @param \Ds\Bundle\ServiceBundle\Service\ScenarioService $scenarioService
     * @param \Ds\Bundle\ServiceBundle\Service\SubmissionService $submissionService
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
     * @Route(path="/scenarios/{uuid}/submissions")
     * @Method("POST")
     * @param string $uuid
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function __invoke($uuid)
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
