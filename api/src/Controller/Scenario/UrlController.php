<?php

namespace App\Controller\Scenario;

use App\Entity\Scenario;
use App\Service\ScenarioService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UrlController
 */
final class UrlController
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
     * @Route(path="/scenarios/{uuid}/url", methods={"GET"})
     * @param string $uuid
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function get($uuid)
    {
        $scenario = $this->scenarioService->getRepository()->findOneBy(['uuid' => $uuid]);

        if (!$scenario) {
            throw new NotFoundHttpException('Scenario not found.');
        }

        if (Scenario::TYPE_URL !== $scenario->getType()) {
            throw new NotFoundHttpException('Scenario url not found.');
        }

        $response = new RedirectResponse($scenario->getConfig()['url']);

        return $response;
    }
}
