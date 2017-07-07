<?php

namespace AppBundle\Action\Scenario\Form;

use AppBundle\Service\ScenarioService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TranslationAction
 */
class TranslationAction
{
    /**
     * @var \AppBundle\Service\ScenarioService
     */
    protected $scenarioService;

    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    protected $requestStack;

    /**
     * @var string
     */
    protected $locale;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\ScenarioService $scenarioService
     * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
     */
    public function __construct(ScenarioService $scenarioService, RequestStack $requestStack, $locale)
    {
        $this->scenarioService = $scenarioService;
        $this->requestStack = $requestStack;
        $this->locale = $locale;
    }

    /**
     * Form
     *
     * @Method("GET")
     * @Route(path="/scenarios/{uuid}/form/translation")
     * @param string $uuid
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function get($uuid)
    {
        $request = $this->requestStack->getCurrentRequest();
        $locale = $request->query->get('locale', 'en');

        return new JsonResponse([$locale => 'test']);
    }
}
