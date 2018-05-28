<?php

namespace AppBundle\Tenant\Initializer;

use Ds\Component\Security\Model\Permission;
use Ds\Component\Security\Service\AccessService;
use Ds\Component\Security\Service\PermissionService;
use Ds\Component\Tenant\Initializer\Initializer;

/**
 * Class AccessInitializer
 */
class AccessInitializer implements Initializer
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
    public function initialize(array $data)
    {
        $items = [
            [
                'owner' => 'System',
                'owner_uuid' => $data['identity']['system']['uuid'],
                'assignee' => 'System',
                'assignee_uuid' => $data['identity']['system']['uuid'],
                'permissions' => [
                    [
                        'scope' => Permission::GENERIC,
                        'key' => 'entity',
                        'attributes' => [Permission::BROWSE, Permission::READ, Permission::EDIT, Permission::ADD, Permission::DELETE]
                    ],
                    [
                        'scope' => Permission::GENERIC,
                        'key' => 'property',
                        'attributes' => [Permission::BROWSE, Permission::READ, Permission::EDIT]
                    ],
                    [
                        'scope' => Permission::GENERIC,
                        'key' => 'generic',
                        'attributes' => [Permission::BROWSE, Permission::READ, Permission::EDIT, Permission::ADD, Permission::DELETE, Permission::EXECUTE]
                    ]
                ]
            ],
            [
                'owner' => 'BusinessUnit',
                'owner_uuid' => $data['business_unit']['administration']['uuid'],
                'assignee' => 'Staff',
                'assignee_uuid' => $data['identity']['admin']['uuid'],
                'permissions' => [
                    [
                        'scope' => Permission::GENERIC,
                        'key' => 'entity',
                        'attributes' => [Permission::BROWSE, Permission::READ, Permission::EDIT, Permission::ADD, Permission::DELETE]
                    ],
                    [
                        'scope' => Permission::GENERIC,
                        'key' => 'property',
                        'attributes' => [Permission::BROWSE, Permission::READ, Permission::EDIT]
                    ],
                    [
                        'scope' => Permission::GENERIC,
                        'key' => 'generic',
                        'attributes' => [Permission::BROWSE, Permission::READ, Permission::EDIT, Permission::ADD, Permission::DELETE, Permission::EXECUTE]
                    ]
                ]
            ]
        ];

        $manager = $this->accessService->getManager();

        foreach ($items as $item) {
            $access = $this->accessService->createInstance();
            $access
                ->setOwner($item['owner'])
                ->setOwnerUuid($item['owner_uuid'])
                ->setAssignee($item['assignee'])
                ->setAssigneeUuid($item['assignee_uuid'])
                ->setTenant($data['tenant']['uuid']);

            foreach ($item['permissions'] as $subItem) {
                $permission = $this->permissionService->createInstance();
                $permission
                    ->setScope($subItem['scope'])
                    ->setKey($subItem['key'])
                    ->setAttributes($subItem['attributes'])
                    ->setTenant($data['tenant']['uuid']);
                $access->addPermission($permission);
            }

            $manager->persist($access);
            $manager->flush();
        }
    }
}
