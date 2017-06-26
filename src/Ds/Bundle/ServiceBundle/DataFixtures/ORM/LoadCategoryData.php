<?php

namespace Ds\Bundle\ServiceBundle\DataFixtures\ORM;

use Ds\Component\Migration\Fixture\ORM\ResourceFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Bundle\ServiceBundle\Entity\Category;
use Ds\Bundle\ServiceBundle\Entity\Service;

/**
 * Class LoadCategoryData
 */
class LoadCategoryData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $categories = $this->parse(__DIR__.'/../../Resources/data/{server}/categories.yml');

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
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 11;
    }
}
