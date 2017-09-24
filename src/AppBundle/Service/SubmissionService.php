<?php

namespace AppBundle\Service;

use AppBundle\Entity\Submission;
use AppBundle\Model\Scenario\Form;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;
use Ds\Component\Api\Api\Factory;
use Ds\Component\Formio\Exception\ValidationException;
use Ds\Component\Formio\Model\Submission as Model;
use Ds\Component\Formio\Query\SubmissionParameters as Parameters;
use Symfony\Component\Validator\ConstraintViolation;

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
     * @var \Ds\Component\Api\Api\Factory
     */
    protected $factory;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param \AppBundle\Service\ScenarioService $scenarioService
     * @param \Ds\Component\Api\Api\Factory $factory
     * @param string $entity
     */
    public function __construct(EntityManager $manager, ScenarioService $scenarioService, Factory $factory, $entity = Submission::class)
    {
        parent::__construct($manager, $entity);

        $this->scenarioService = $scenarioService;
        $this->factory = $factory;
    }

    /**
     * Check if a submission is valid
     *
     * @param \AppBundle\Entity\Submission $submission
     * @param array $violations
     * @return boolean
     */
    public function isValid(Submission $submission, array &$violations = [])
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
                $api = $this->factory->create();

                try {
                    $api->formio->submission->create($model, $parameters);

                    return true;
                } catch (ValidationException $exception) {
                    foreach ($exception->getErrors() as $error) {
                        $message = $error->message;
                        $template = '%s: %s';
                        $parameters = ['data.'.$error->path, $error->message];
                        $root = '';
                        $path = 'data.'.$error->path;
                        $value = null;
                        $violations[] = new ConstraintViolation($message, $template, $parameters, $root, $path, $value);
                    }

                    return false;
                }

                break;
        }

        return true;
    }
}
