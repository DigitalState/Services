<?php

namespace AppBundle\Action\Scenario;

use AppBundle\Entity\Scenario;
use AppBundle\Service\ScenarioService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UrlAction
 */
class UrlAction
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
     * @Route(path="/scenarios/{uuid}/url")
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

        $response = new RedirectResponse($scenario->getConfig('url'));

        return $response;
    }
}
