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
        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $service = new Service;
            $service
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setSlug($object->slug)
                ->setTitle((array) $object->title)
                ->setDescription((array) $object->description)
                ->setPresentation((array) $object->presentation)
                ->setData((array) $object->data)
                ->setEnabled($object->enabled)
                ->setWeight($object->weight)
                ->setTenant($object->tenant);
            $manager->persist($service);
            $manager->flush();
        }
    }
}
