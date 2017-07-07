<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Service;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Migration\Fixture\ORM\ResourceFixture;

/**
 * Class LoadServiceData
 */
class LoadServiceData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $services = $this->parse(__DIR__.'/../../Resources/data/{server}/services.yml');

        foreach ($services as $service) {
            $entity = new Service;
            $entity
                ->setUuid($service['uuid'])
                ->setOwner($service['owner'])
                ->setOwnerUuid($service['owner_uuid'])
                ->setTitle($service['title'])
                ->setDescription($service['description'])
                ->setPresentation($service['presentation'])
                ->setEnabled($service['enabled'])
                ->setWeight($service['weight']);
            $manager->persist($entity);
            $manager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }
}
