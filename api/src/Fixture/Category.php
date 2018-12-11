<?php

namespace App\Fixture;

use App\Entity\Category as CategoryEntity;
use App\Entity\Service;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

/**
 * Trait Category
 */
trait Category
{
    use Yaml;

    /**
     * @var string
     */
    private $path;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $connection = $manager->getConnection();
        $platform = $connection->getDatabasePlatform()->getName();

        switch ($platform) {
            case 'postgresql':
                $connection->exec('ALTER SEQUENCE app_category_id_seq RESTART WITH 1');
                $connection->exec('ALTER SEQUENCE app_category_trans_id_seq RESTART WITH 1');
                break;
        }

        $objects = $this->parse($this->path);

        foreach ($objects as $object) {
            $category = new CategoryEntity;
            $category
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setSlug($object->slug)
                ->setTitle((array) $object->title)
                ->setDescription((array) $object->description)
                ->setPresentation((array) $object->presentation)
                ->setData(json_decode(json_encode($object->data), true))
                ->setEnabled($object->enabled)
                ->setWeight($object->weight)
                ->setTenant($object->tenant);

            foreach ($object->services as $uuid) {
                $service = $manager->getRepository(Service::class)->findOneBy(['uuid' => $uuid]);
                $category->addService($service);
            }

            $manager->persist($category);
            $manager->flush();
        }
    }
}
