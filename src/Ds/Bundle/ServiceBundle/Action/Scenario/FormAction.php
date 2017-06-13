<?php

namespace Ds\Bundle\ServiceBundle\Action\Scenario;

use Ds\Bundle\ServiceBundle\Service\ScenarioService;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class FormAction
 */
class FormAction
{
    /**
     * @var \Ds\Bundle\ServiceBundle\Service\ScenarioService
     */
    protected $scenarioService;

    /**
     * Constructor
     *
     * @param \Ds\Bundle\ServiceBundle\Service\ScenarioService $scenarioService
     */
    public function __construct(ScenarioService $scenarioService)
    {
        $this->scenarioService = $scenarioService;
    }

    /**
     * Form
     *
     * @Route(path="/scenarios/{id}/form")
     * @Method("GET")
     * @param integer $id
     * @return string
     */
    public function __invoke($id)
    {
        $scenario = $this->scenarioService->getRepository()->find($id);
        $formSchema = $this->scenarioService->getFormSchema($scenario);

        return new JsonResponse($formSchema);
    }
}
