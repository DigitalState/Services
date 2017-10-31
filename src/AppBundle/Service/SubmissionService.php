<?php

namespace AppBundle\Service;

use AppBundle\Entity\Submission;
use AppBundle\Model\Scenario\Form;
use Doctrine\ORM\EntityManager;
use Ds\Component\Api\Api\Api;
use Ds\Component\Entity\Service\EntityService;
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
     * @var \Ds\Component\Api\Api\Api
     */
    protected $api;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param \AppBundle\Service\ScenarioService $scenarioService
     * @param \Ds\Component\Api\Api\Api $api
     * @param string $entity
     */
    public function __construct(EntityManager $manager, ScenarioService $scenarioService, Api $api, $entity = Submission::class)
    {
        parent::__construct($manager, $entity);
        $this->scenarioService = $scenarioService;
        $this->api = $api;
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

                try {
                    $this->api->get('formio.submission')->create($model, $parameters);

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
