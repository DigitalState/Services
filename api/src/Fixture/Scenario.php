<?php

namespace App\Fixture;

use App\Entity\Service;
use App\Entity\Scenario as ScenarioEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

/**
 * Trait Scenario
 */
trait Scenario
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
                $connection->exec('ALTER SEQUENCE app_scenario_id_seq RESTART WITH 1');
                $connection->exec('ALTER SEQUENCE app_scenario_trans_id_seq RESTART WITH 1');
                break;
        }

        $objects = $this->parse($this->path);

        foreach ($objects as $object) {
            $service = $manager->getRepository(Service::class)->findOneBy(['uuid' => $object->service]);
            $scenario = new ScenarioEntity;
            $scenario
                ->setService($service)
                ->setType($object->type)
                ->setConfig((array) $object->config)
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
            $manager->persist($scenario);
            $manager->flush();
        }
    }
}
