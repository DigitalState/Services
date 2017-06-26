<?php

namespace Ds\Bundle\ServiceBundle\Service;

use Ds\Component\Entity\Service\EntityService;
use Doctrine\ORM\EntityManager;
use Ds\Component\Formio\Api\Api;
use Ds\Component\Config\Service\ConfigService;
use Ds\Bundle\ServiceBundle\Entity\Submission;
use Ds\Bundle\ServiceBundle\Model\Scenario\Form;
use Ds\Component\Formio\Model\Submission as Model;
use Ds\Component\Formio\Query\SubmissionParameters as Parameters;
use Ds\Component\Formio\Exception\ValidationException;

/**
 * Class SubmissionService
 */
class SubmissionService extends EntityService
{
    /**
     * @var \Ds\Bundle\ServiceBundle\Service\ScenarioService
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
     * @param \Ds\Bundle\ServiceBundle\Service\ScenarioService $scenarioService
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
     * @param \Ds\Bundle\ServiceBundle\Entity\Submission $submission
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
                $this->formio->setHost($this->configService->get('ds_service.services.formio.url'));

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
