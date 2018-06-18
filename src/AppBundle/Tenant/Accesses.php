<?php

namespace AppBundle\Tenant;

use Ds\Component\Security\Service\AccessService;
use Ds\Component\Security\Service\PermissionService;
use Ds\Component\Tenant\Loader\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Accesses
 */
class Accesses implements Loader
{
    /**
     * @var \Ds\Component\Security\Service\AccessService
     */
    protected $accessService;

    /**
     * @var \Ds\Component\Security\Service\PermissionService
     */
    protected $permissionService;

    /**
     * Constructor
     *
     * @param \Ds\Component\Security\Service\AccessService $accessService
     * @param \Ds\Component\Security\Service\PermissionService $permissionService
     */
    public function __construct(AccessService $accessService, PermissionService $permissionService)
    {
        $this->accessService = $accessService;
        $this->permissionService = $permissionService;
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $data)
    {
        $yml = file_get_contents('/srv/api-platform/src/AppBundle/Resources/tenant/accesses.yml');

        // @todo Figure out how symfony does parameter binding and use the same technique
        $yml = strtr($yml, [
            '%identity.system.uuid%' => $data['identity']['system']['uuid'],
            '%business_unit.administration.uuid%' => $data['business_unit']['administration']['uuid'],
            '%identity.admin.uuid%' => $data['identity']['admin']['uuid'],
            '%tenant.uuid%' => $data['tenant']['uuid']
        ]);

        $accesses = Yaml::parse($yml, YAML::PARSE_OBJECT_FOR_MAP);
        $manager = $this->accessService->getManager();

        foreach ($accesses->objects as $object) {
            $object = (object) array_merge((array) $accesses->prototype, (array) $object);
            $access = $this->accessService->createInstance();
            $access
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setAssignee($object->assignee)
                ->setAssigneeUuid($object->assignee_uuid)
                ->setTenant($object->tenant);

            foreach ($object->permissions as $subObject) {
                $permission = $this->permissionService->createInstance();
                $permission
                    ->setScope($subObject->scope)
                    ->setKey($subObject->key)
                    ->setAttributes($subObject->attributes)
                    ->setTenant($object->tenant);
                $access->addPermission($permission);
            }

            $manager->persist($access);
            $manager->flush();
        }
    }
}
