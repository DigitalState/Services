<?php

namespace AppBundle\Tenant;

use Ds\Component\Config\Service\ConfigService;
use Ds\Component\Tenant\Loader\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Configs
 */
class Configs implements Loader
{
    /**
     * @var \Ds\Component\Config\Service\ConfigService
     */
    protected $configService;

    /**
     * Constructor
     *
     * @param \Ds\Component\Config\Service\ConfigService $configService
     */
    public function __construct(ConfigService $configService)
    {
        $this->configService = $configService;
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $data)
    {
        $yml = file_get_contents('/srv/api-platform/src/AppBundle/Resources/tenant/configs.yml');

        // @todo Figure out how symfony does parameter binding and use the same technique
        $yml = strtr($yml, [
            '%config.app.spa.admin.value%' => $data['config']['app.spa.admin']['value'],
            '%config.app.spa.portal.value%' => $data['config']['app.spa.portal']['value'],
            '%business_unit.administration.uuid%' => $data['business_unit']['administration']['uuid'],
            '%tenant.uuid%' => $data['tenant']['uuid']
        ]);

        $configs = Yaml::parse($yml, YAML::PARSE_OBJECT_FOR_MAP);
        $manager = $this->configService->getManager();

        foreach ($configs->objects as $object) {
            $object = (object) array_merge((array) $configs->prototype, (array) $object);
            $config = $this->configService->createInstance();
            $config
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setKey($object->key)
                ->setValue($object->value)
                ->setTenant($object->tenant);
            $manager->persist($config);
            $manager->flush();
        }
    }
}
