<?php

namespace AppBundle\Service;

use AppBundle\Entity\Scenario;
use AppBundle\Model\Scenario\Form;
use Doctrine\ORM\EntityManager;
use Ds\Component\Bpm\Bridge\Symfony\Bundle\Api\Factory;
use Ds\Component\Bpm\Query\ProcessDefinitionParameters;
use Ds\Component\Config\Service\ConfigService;
use Ds\Component\Entity\Service\EntityService;
use Ds\Component\Formio\Api\Api;
use Ds\Component\Formio\Query\FormParameters;
use DomainException;

/**
 * Class ScenarioService
 */
class ScenarioService extends EntityService
{
    /**
     * @var \Ds\Component\Bpm\Bridge\Symfony\Bundle\Api\Factory
     */
    protected $bpmFactory;

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
     * @param \Ds\Component\Bpm\Bridge\Symfony\Bundle\Api\Factory $bpmFactory
     * @param \Ds\Component\Formio\Api\Api $formio
     * @param \Ds\Component\Config\Service\ConfigService $configService
     */
    public function __construct(EntityManager $manager, $entity, Factory $bpmFactory, Api $formio, ConfigService $configService)
    {
        parent::__construct($manager, $entity);

        $this->bpmFactory = $bpmFactory;
        $this->formio = $formio;
        $this->configService = $configService;
    }

    /**
     * Get form
     *
     * @param \AppBundle\Entity\Scenario $scenario
     * @return \AppBundle\Model\Scenario\Form
     * @throws \DomainException
     */
    public function getForm(Scenario $scenario)
    {
        $form = new Form;

        switch ($scenario->getType()) {
            case Scenario::TYPE_BPM:
                $api = $this->bpmFactory->api($scenario->getData('bpm'));
                $api->setHost($this->configService->get('app.services.camunda.url'));
                $parameters = new ProcessDefinitionParameters;
                $parameters->setKey($scenario->getData('process_definition_key'));
                list($type, $id) = explode(':', $api->processDefinition->getStartForm(null, $parameters), 2);
                $form
                    ->setType($type)
                    ->setId($id);

                break;

            default:
                throw new DomainException('Scenario type does not exist.');
        }

        switch ($form->getType()) {
            case Form::TYPE_FORMIO:
                $this->formio->setHost($this->configService->get('app.services.formio.url'));
                $parameters = new FormParameters;
                $parameters->setPath($id);
                $components = $this->formio->form->get(null, $parameters)->getComponents();
                $form
                    ->setSchema($components)
                    ->setMethod('POST')
                    ->setAction('/scenarios/'.$scenario->getUuid().'/submissions');

                break;

            default:
                throw new DomainException('Scenario form type does not exist.');
        }

        return $form;
    }
}
