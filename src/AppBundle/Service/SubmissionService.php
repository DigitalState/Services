<?php

namespace AppBundle\Service;

use AppBundle\Entity\Submission;
use AppBundle\Model\Scenario\Form;
use Doctrine\ORM\EntityManager;
use Ds\Component\Config\Service\ConfigService;
use Ds\Component\Entity\Service\EntityService;
use Ds\Component\Formio\Api\Api;
use Ds\Component\Formio\Exception\ValidationException;
use Ds\Component\Formio\Model\Submission as Model;
use Ds\Component\Formio\Query\SubmissionParameters as Parameters;

/**
 * Class SubmissionService
 */
class SubmissionService extends EntityService
{
    /**
     * @var \AppBundle\Service\ScenarioService
     */
    protected $scenarioService;

    /**
     * @var \Ds\Component\Formio\Api\Api
     */
    protected $formio;

    /**
     * @var \Ds\Component\Config\Service\ConfigService
     */
    protected $configService;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     * @param \AppBundle\Service\ScenarioService $scenarioService
     * @param \Ds\Component\Formio\Api\Api $formio
     * @param \Ds\Component\Config\Service\ConfigService $configService
     */
    public function __construct(EntityManager $manager, $entity, ScenarioService $scenarioService, Api $formio, ConfigService $configService)
    {
        parent::__construct($manager, $entity);

        $this->scenarioService = $scenarioService;
        $this->formio = $formio;
        $this->configService = $configService;
    }

    /**
     * Check if a submission is valid
     *
     * @param \AppBundle\Entity\Submission $submission
     * @return boolean
     */
    public function isValid(Submission $submission)
    {
        $scenario = $submission->getScenario();
        $form = $this->scenarioService->getForm($scenario);

        switch ($form->getType()) {
            case Form::TYPE_FORMIO:
                $model = new Model;
                $model
                    ->setForm($form->getId())
                    ->setData((object) $submission->getData());
                $parameters = new Parameters;
                $this->formio->setHost($this->configService->get('app.services.formio.url'));

                try {
                    $this->formio->submission->create($model, $parameters);

                    return true;
                } catch (ValidationException $exception) {
                    return false;
                }

                break;
        }

        return true;
    }
}
