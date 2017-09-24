<?php

namespace AppBundle\Service;

use AppBundle\Entity\Scenario;
use AppBundle\Model\Scenario\Form;
use Doctrine\ORM\EntityManager;
use DomainException;
use Ds\Component\Api\Api\Factory;
use Ds\Component\Camunda\Query\ProcessDefinitionParameters;
use Ds\Component\Entity\Service\EntityService;
use Ds\Component\Formio\Query\FormParameters;
use Ds\Component\Resolver\Collection\ResolverCollection;
use Ds\Component\Resolver\Exception\UnmatchedException;
use Ds\Component\Resolver\Exception\UnresolvedException;

/**
 * Class ScenarioService
 */
class ScenarioService extends EntityService
{
    /**
     * @var \Ds\Component\Api\Api\Factory
     */
    protected $factory;

    /**
     * @var \Ds\Component\Resolver\Collection\ResolverCollection
     */
    protected $resolverCollection;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param \Ds\Component\Api\Api\Factory $factory
     * @param \Ds\Component\Resolver\Collection\ResolverCollection $resolverCollection
     * @param string $entity
     */
    public function __construct(EntityManager $manager, Factory $factory, ResolverCollection $resolverCollection, $entity = Scenario::class)
    {
        parent::__construct($manager, $entity);

        $this->factory = $factory;
        $this->resolverCollection = $resolverCollection;
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
        $api = $this->factory->create();

        switch ($scenario->getType()) {
            case Scenario::TYPE_BPM:
                $parameters = new ProcessDefinitionParameters;
                $parameters->setKey($scenario->getConfig('process_definition_key'));
                $startForm = $api->camunda->processDefinition->getStartForm(null, $parameters);

                if (null === $startForm) {
                    return null;
                }

                list($type, $id) = explode(':', $startForm, 2);
                $form
                    ->setType($type)
                    ->setId($id);

                break;

            default:
                throw new DomainException('Scenario type does not exist.');
        }

        switch ($form->getType()) {
            case Form::TYPE_FORMIO:
                $parameters = new FormParameters;
                $parameters->setPath($id);
                $components = $api->formio->form->get(null, $parameters)->getComponents();

                foreach ($components as &$component) {
                    $this->resolveComponent($component);
                }

                $form
                    ->setSchema($components)
                    ->setMethod('POST')
                    ->setAction('/scenarios/'.$scenario->getUuid().'/submissions');

                break;

            case Form::TYPE_SYMFONY:
                break;

            default:
                throw new DomainException('Scenario form type does not exist.');
        }

        return $form;
    }

    /**
     * Resolve component default value
     *
     * @param \stdClass $component
     */
    protected function resolveComponent(&$component)
    {
        switch (true) {
            case property_exists($component, 'components'):
                foreach ($component->components as &$subComponent) {
                    $this->resolveComponent($subComponent);
                }

                break;

            case property_exists($component, 'columns'):
                foreach ($component->columns as &$column) {
                    foreach ($column->components as &$subComponent) {
                        $this->resolveComponent($subComponent);
                    }
                }

                break;

            case property_exists($component, 'defaultValue'):
                try {
                    $component->defaultValue = $this->resolverCollection->resolve($component->defaultValue);
                } catch (UnresolvedException $exception) {
                    $component->defaultValue = null;
                } catch (UnmatchedException $exception) {
                    // Leave default value as-is
                }

                break;
        }
    }
}
