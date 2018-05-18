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
        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $scenario = new Scenario;
            $scenario
                ->setService($manager->getRepository(Service::class)->findOneBy(['uuid' => $object->service]))
                ->setType($object->type)
                ->setConfig((array) $object->config)
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
            $manager->persist($scenario);
            $manager->flush();
        }
    }
}
