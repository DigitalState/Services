<?php

namespace App\Service;

use App\Entity\Submission;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Api\Api\Api;
use Ds\Component\Entity\Service\EntityService;
use Ds\Component\Form\Model\Form;
use Ds\Component\Formio\Exception\ValidationException;
use Ds\Component\Formio\Model\Submission as Model;
use Ds\Component\Formio\Query\SubmissionParameters as Parameters;
use Symfony\Component\Validator\ConstraintViolation;

/**
 * Class SubmissionService
 */
final class SubmissionService extends EntityService
{
    /**
     * @var \App\Service\ScenarioService
     */
    private $scenarioService;

    /**
     * @var \Ds\Component\Api\Api\Api
     */
    private $api;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param \App\Service\ScenarioService $scenarioService
     * @param \Ds\Component\Api\Api\Api $api
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, ScenarioService $scenarioService, Api $api, string $entity = Submission::class)
    {
        parent::__construct($manager, $entity);
        $this->scenarioService = $scenarioService;
        $this->api = $api;
    }

    /**
     * Check if a submission is valid
     *
     * @param \App\Entity\Submission $submission
     * @param array $violations
     * @param boolean $overwrite
     * @return boolean
     */
    public function isValid(Submission $submission, array &$violations = [], $overwrite = true)
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
                    $model = $this->api->get('formio.submission')->create($model, $parameters);

                    if ($overwrite) {
                        $submission->setData((array) $model->getData());
                    }

                    return true;
                } catch (ValidationException $exception) {
                    foreach ($exception->getErrors() as $error) {
                        $message = $error->message;
                        $path = 'data.'.array_shift($error->path);
                        $template = '%s: %s';
                        $parameters = [$path, $message];
                        $root = '';
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
