<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Service;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class ServiceFixture
 */
abstract class ServiceFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $services = $this->parse($this->getResource());

        foreach ($services as $service) {
            $entity = new Service;
            $entity
                ->setUuid($service['uuid'])
                ->setOwner($service['owner'])
                ->setOwnerUuid($service['owner_uuid'])
                ->setSlug($service['slug'])
                ->setTitle($service['title'])
                ->setDescription($service['description'])
                ->setPresentation($service['presentation'])
                ->setData($service['data'])
                ->setEnabled($service['enabled'])
                ->setWeight($service['weight']);
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
