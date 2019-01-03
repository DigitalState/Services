<?php

namespace App\Controller\Scenario;

use App\Service\ScenarioService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FormsController
 */
final class FormsController
{
    /**
     * @var \App\Service\ScenarioService
     */
    private $scenarioService;

    /**
     * Constructor
     *
     * @param \App\Service\ScenarioService $scenarioService
     */
    public function __construct(ScenarioService $scenarioService)
    {
        $this->scenarioService = $scenarioService;
    }

    /**
     * Form
     *
     * @Route(path="/scenarios/{uuid}/forms", methods={"GET"})
     * @param string $uuid
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function get($uuid)
    {
        $scenario = $this->scenarioService->getRepository()->findOneBy(['uuid' => $uuid]);

        if (!$scenario) {
            throw new NotFoundHttpException('Scenario not found.');
        }

        $forms = $this->scenarioService->getForms($scenario);

        foreach ($forms as $key => $value) {
            $forms[$key] = $value->toObject();
        }

        $response = new JsonResponse($forms);

        return $response;
    }
}
