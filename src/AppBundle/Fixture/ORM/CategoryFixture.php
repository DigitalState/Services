<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\Category;
use AppBundle\Entity\Service;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Migration\Fixture\ORM\ResourceFixture;

/**
 * Class CategoryFixture
 */
abstract class CategoryFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $categories = $this->parse($this->getResource());

        foreach ($categories as $category) {
            $entity = new Category;
            $entity
                ->setUuid($category['uuid'])
                ->setOwner($category['owner'])
                ->setOwnerUuid($category['owner_uuid'])
                ->setTitle($category['title'])
                ->setDescription($category['description'])
                ->setPresentation($category['presentation'])
                ->setEnabled($category['enabled'])
                ->setWeight($category['weight']);

            foreach ($category['services'] as $service) {
                $entity->addService($manager->getRepository(Service::class)->findOneBy(['uuid' => $service]));
            }

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
