<?php

namespace Ds\Bundle\ServiceBundle\Action\Scenario;

use Ds\Bundle\ServiceBundle\Service\ScenarioService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
     * @Route(path="/scenarios/{uuid}/form")
     * @Method("GET")
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

        $form = $this->scenarioService->getForm($scenario);

        return new JsonResponse($form->toObject());
    }
}
