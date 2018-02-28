<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Service;
use AppBundle\Entity\Scenario;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class ScenarioFixture
 */
abstract class ScenarioFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $scenarios = $this->parse($this->getResource());

        foreach ($scenarios as $scenario) {
            $entity = new Scenario;
            $entity
                ->setService($manager->getRepository(Service::class)->findOneBy(['uuid' => $scenario['service']]))
                ->setType($scenario['type'])
                ->setConfig($scenario['config'])
                ->setUuid($scenario['uuid'])
                ->setOwner($scenario['owner'])
                ->setOwnerUuid($scenario['owner_uuid'])
                ->setSlug($scenario['slug'])
                ->setTitle($scenario['title'])
                ->setDescription($scenario['description'])
                ->setPresentation($scenario['presentation'])
                ->setData($scenario['data'])
                ->setEnabled($scenario['enabled'])
                ->setWeight($scenario['weight']);
            $manager->persist($entity);
            $manager->flush();
        }
    }

    /**
     * Get resource
     *
     * @return string
     */
    abstract protected function getResource();
}
