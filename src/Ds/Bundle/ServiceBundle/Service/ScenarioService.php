<?php

namespace Ds\Bundle\ServiceBundle\Service;

use Ds\Component\Entity\Service\EntityService;
use Doctrine\ORM\EntityManager;
use Ds\Component\Bpm\Bridge\Symfony\Bundle\Api\Factory;
use Ds\Component\Formio\Api\Api;
use Ds\Component\Config\Service\ConfigService;
use Ds\Bundle\ServiceBundle\Entity\Scenario;
use Ds\Component\Bpm\Query\ProcessDefinitionParameters;
use Ds\Bundle\ServiceBundle\Model\Scenario\Form;

/**
 * Class ScenarioService
 */
class ScenarioService extends EntityService
{
    /**
     * @var Factory
     */
    protected $factory;

    /**
     * @var Api
     */
    protected $api;

    /**
     * @var ConfigService
     */
    protected $configService;

    /**
     * Constructor
     *
     * @param EntityManager $manager
     * @param Factory $factory
     * @param Api $api
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
     * @param Scenario $scenario
     * @return Form
     */
    public function getForm(Scenario $scenario)
    {
        $type = $scenario->getType();

        switch ($type) {
            case Scenario::TYPE_BPM:
                $api = $this->factory->api($scenario->getData('bpm'));
                $api->setHost($this->configService->get('ds_service.services.camunda.url'));
                $parameters = new ProcessDefinitionParameters;
                $parameters->setKey($scenario->getData('process_definition_key'));
                $form = $api->processDefinition->getStartForm(null, $parameters);
                list($type, $value) = explode(':', $form, 2);
                $form = new Form;
                $form
                    ->setType($type)
                    ->setValue($value);

                break;

            default:
                $form = null;
        }

        return $form;
    }

    /**
     * Get form schema
     *
     * @param Scenario $scenario
     * @return array
     */
    public function getFormSchema(Scenario $scenario)
    {
        $form = $this->getForm($scenario);

        return [
            'schema' => (object) []
        ];
    }
}
