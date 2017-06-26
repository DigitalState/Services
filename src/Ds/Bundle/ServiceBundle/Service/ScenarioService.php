<?php

namespace Ds\Bundle\ServiceBundle\Service;

use Ds\Component\Entity\Service\EntityService;
use Doctrine\ORM\EntityManager;
use Ds\Component\Bpm\Bridge\Symfony\Bundle\Api\Factory;
use Ds\Component\Formio\Api\Api;
use Ds\Component\Config\Service\ConfigService;
use Ds\Bundle\ServiceBundle\Entity\Scenario;
use Ds\Component\Bpm\Query\ProcessDefinitionParameters;
use Ds\Component\Formio\Query\FormParameters;
use Ds\Bundle\ServiceBundle\Model\Scenario\Form;
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
     * @param \Ds\Component\Bpm\Bridge\Symfony\Bundle\Api\Factory $bpmFactory
     * @param \Ds\Component\Formio\Api\Api $formio
     * @param \Ds\Component\Config\Service\ConfigService $configService
     * @param string $entity
     */
    public function __construct(EntityManager $manager, Factory $bpmFactory, Api $formio, ConfigService $configService, $entity)
    {
        parent::__construct($manager, $entity);

        $this->bpmFactory = $bpmFactory;
        $this->formio = $formio;
        $this->configService = $configService;
    }

    /**
     * Get form
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Scenario $scenario
     * @return \Ds\Bundle\ServiceBundle\Model\Scenario\Form
     * @throws \DomainException
     */
    public function getForm(Scenario $scenario)
    {
        $form = new Form;

        switch ($scenario->getType()) {
            case Scenario::TYPE_BPM:
                $api = $this->bpmFactory->api($scenario->getData('bpm'));
                $api->setHost($this->configService->get('ds_service.services.camunda.url'));
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
                $this->formio->setHost($this->configService->get('ds_service.services.formio.url'));
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
