<?php

namespace AppBundle\Action\Scenario;

use AppBundle\Service\ScenarioService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FormsAction
 */
class FormsAction
{
    /**
     * @var \AppBundle\Service\ScenarioService
     */
    protected $scenarioService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\ScenarioService $scenarioService
     */
    public function __construct(ScenarioService $scenarioService)
    {
        $this->scenarioService = $scenarioService;
    }

    /**
     * Form
     *
     * @Method("GET")
     * @Route(path="/scenarios/{uuid}/forms")
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
