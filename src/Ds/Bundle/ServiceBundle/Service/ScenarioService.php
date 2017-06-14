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
    protected $factory;

    /**
     * @var \Ds\Component\Formio\Api\Api
     */
    protected $api;

    /**
     * @var \Ds\Component\Config\Service\ConfigService
     */
    protected $configService;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param \Ds\Component\Bpm\Bridge\Symfony\Bundle\Api\Factory $factory
     * @param \Ds\Component\Formio\Api\Api $api
     * @param string $entity
     */
    public function __construct(EntityManager $manager, Factory $factory, Api $api, ConfigService $configService, $entity = Scenario::class)
    {
        parent::__construct($manager, $entity);

        $this->factory = $factory;
        $this->api = $api;
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
                $api = $this->factory->api($scenario->getData('bpm'));
                $api->setHost($this->configService->get('ds_service.services.camunda.url'));
                $parameters = new ProcessDefinitionParameters;
                $parameters->setKey($scenario->getData('process_definition_key'));
                list($type, $value) = explode(':', $api->processDefinition->getStartForm(null, $parameters), 2);
                $form->setType($type);

                break;

            default:
                throw new DomainException('Scenario type does not exist.');
        }

        switch ($form->getType()) {
            case Form::TYPE_FORMIO:
                $this->api->setHost($this->configService->get('ds_service.services.formio.url'));
                $parameters = new FormParameters;
                $parameters->setPath($value);
                $components = $this->api->form->get(null, $parameters)->getComponents();
                $form->setSchema($components);
                break;

            default:
                throw new DomainException('Scenario form type does not exist.');
        }

        return $form;
    }
}
