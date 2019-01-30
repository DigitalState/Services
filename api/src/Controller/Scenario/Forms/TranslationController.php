<?php

namespace App\Controller\Scenario\Forms;

use App\Service\ScenarioService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TranslationController
 */
final class TranslationController
{
    /**
     * @var \App\Service\ScenarioService
     */
    private $scenarioService;

    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    private $requestStack;

    /**
     * @var string
     */
    private $locale;

    /**
     * Constructor
     *
     * @param \App\Service\ScenarioService $scenarioService
     * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
     */
    public function __construct(ScenarioService $scenarioService, RequestStack $requestStack, string $locale)
    {
        $this->scenarioService = $scenarioService;
        $this->requestStack = $requestStack;
        $this->locale = $locale;
    }

    /**
     * Form
     *
     * @Route(path="/scenarios/{uuid}/forms/translation", methods={"GET"})
     * @param string $uuid
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function get($uuid)
    {
        $request = $this->requestStack->getCurrentRequest();
        $locale = $request->query->get('locale', 'en');
        $response = new JsonResponse([$locale => 'test']);

        return $response;
    }
}
