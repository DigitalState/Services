<?php

namespace Ds\Bundle\ServiceBundle\DataFixtures\ORM;

use Ds\Component\Migration\Fixture\ORM\ResourceFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Bundle\ServiceBundle\Entity\Service;
use Ds\Bundle\ServiceBundle\Entity\Scenario;

/**
 * Class LoadScenarioData
 */
class LoadScenarioData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $scenarios = $this->parse(__DIR__.'/../../Resources/data/{server}/scenarios.yml');

        foreach ($scenarios as $scenario) {
            $entity = new Scenario;
            $entity
                ->setService($manager->getRepository(Service::class)->findOneBy(['uuid' => $scenario['service']]))
                ->setType($scenario['type'])
                ->setUuid($scenario['uuid'])
                ->setOwner($scenario['owner'])
                ->setOwnerUuid($scenario['owner_uuid'])
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
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 11;
    }
}
