<?php

namespace App\Service;

use App\Entity\Scenario;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;
use Ds\Component\Api\Api\Api;
use Ds\Component\Camunda\Query\ProcessDefinitionParameters;
use Ds\Component\Entity\Service\EntityService;
use Ds\Component\Form\Service\FormService;

/**
 * Class ScenarioService
 */
final class ScenarioService extends EntityService
{
    /**
     * @var \Ds\Component\Api\Api\Api
     */
    private $api;

    /**
     * @var \Ds\Component\Form\Service\FormService
     */
    private $formService;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param \Ds\Component\Api\Api\Api $api
     * @param \Ds\Component\Form\Service\FormService $formService
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, Api $api, FormService $formService, string $entity = Scenario::class)
    {
        parent::__construct($manager, $entity);
        $this->api = $api;
        $this->formService = $formService;
    }

    /**
     * Get form
     *
     * @param \App\Entity\Scenario $scenario
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
     * @param \App\Entity\Scenario $scenario
     * @return array
     * @throws \DomainException
     */
    public function getForms(Scenario $scenario)
    {
        switch ($scenario->getType()) {
            case Scenario::TYPE_BPM:
                $config = $scenario->getConfig();

                if (array_key_exists('form_key', $config)) {
                    $id = $config['form_key'];
                } else {
                    $parameters = new ProcessDefinitionParameters;
                    $parameters
                        ->setKey($scenario->getConfig('process_definition_key'))
                        ->setTenantId($scenario->getTenant());
                    $id = $this->api->get('camunda.process_definition')->getStartForm(null, $parameters);
                }

                if (null === $id) {
                    return [];
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
