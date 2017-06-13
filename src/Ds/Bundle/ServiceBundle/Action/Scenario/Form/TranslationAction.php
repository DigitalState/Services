<?php

namespace Ds\Bundle\ServiceBundle\Action\Scenario\Form;

use Symfony\Component\HttpFoundation\RequestStack;
use Ds\Bundle\ServiceBundle\Service\ScenarioService;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class TranslationAction
 */
class TranslationAction
{
    /**
     * @var \Ds\Bundle\ServiceBundle\Service\ScenarioService
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
     * @param \Ds\Bundle\ServiceBundle\Service\ScenarioService $scenarioService
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
     * @Route(path="/scenarios/{id}/form/translation")
     * @Method("GET")
     * @param integer $id
     * @return string
     */
    public function __invoke($id)
    {
        $request = $this->requestStack->getCurrentRequest();
        $locale = $request->query->get('locale', 'en');

        return new JsonResponse([$locale => 'test']);
    }
}
