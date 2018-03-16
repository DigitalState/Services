<?php

namespace AppBundle\Service;

use AppBundle\Entity\Scenario;
use Doctrine\ORM\EntityManager;
use DomainException;
use Ds\Component\Api\Api\Api;
use Ds\Component\Camunda\Query\ProcessDefinitionParameters;
use Ds\Component\Entity\Service\EntityService;
use Ds\Component\Form\Service\FormService;

/**
 * Class ScenarioService
 */
class ScenarioService extends EntityService
{
    /**
     * @var \Ds\Component\Api\Api\Api
     */
    protected $api;

    /**
     * @var \Ds\Component\Form\Service\FormService
     */
    protected $formService;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param \Ds\Component\Api\Api\Api $api
     * @param \Ds\Component\Form\Service\FormService $formService
     * @param string $entity
     */
    public function __construct(EntityManager $manager, Api $api, FormService $formService, $entity = Scenario::class)
    {
        parent::__construct($manager, $entity);

        $this->api = $api;
        $this->formService = $formService;
    }

    /**
     * Get form
     *
     * @param \AppBundle\Entity\Scenario $scenario
     * @return \Ds\Component\Form\Model\Form
     * @throws \DomainException
     */
    public function getForm(Scenario $scenario)
    {
        $forms = $this->getForms($scenario);

        foreach ($forms as $form) {
            if ($form->getPrimary()) {
                return $form;
            }
        }
    }

    /**
     * Get forms
     *
     * @param \AppBundle\Entity\Scenario $scenario
     * @return array
     * @throws \DomainException
     */
    public function getForms(Scenario $scenario)
    {
        switch ($scenario->getType()) {
            case Scenario::TYPE_BPM:
                $parameters = new ProcessDefinitionParameters;
                $parameters->setKey($scenario->getConfig('process_definition_key'));
                $id = $this->api->get('camunda.process_definition')->getStartForm(null, $parameters);

                if (null === $id) {
                    return null;
                }

                break;

            default:
                throw new DomainException('Scenario type does not exist.');
        }

        $forms = $this->formService->getForms($id);

        foreach ($forms as $key => $form) {
            $form = $this->formService->resolve($form);

            if ($form->getPrimary()) {
                // @todo Perhaps use the route generator.
                $form->setAction('/scenarios/'.$scenario->getUuid().'/submissions');
            }

            $forms[$key] = $form;
        }

        return $forms;
    }
}
