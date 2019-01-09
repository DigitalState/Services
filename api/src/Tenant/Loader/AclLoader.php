<?php

namespace App\Tenant\Loader;

use Ds\Component\Acl\Service\AccessService;
use Ds\Component\Acl\Service\PermissionService;
use Ds\Component\Acl\Tenant\Loader\Acl;
use Ds\Component\Tenant\Loader\Loader;

/**
 * Class AclLoader
 */
final class AclLoader implements Loader
{
    use Acl;

    /**
     * Constructor
     *
     * @param \Ds\Component\Acl\Service\AccessService $accessService
     * @param \Ds\Component\Acl\Service\PermissionService $permissionService
     */
    public function __construct(AccessService $accessService, PermissionService $permissionService)
    {
        $this->accessService = $accessService;
        $this->permissionService = $permissionService;
        $this->path = '/srv/api/config/tenant/loader/acl.yaml';
    }
}
