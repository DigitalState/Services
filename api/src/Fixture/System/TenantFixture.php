<?php

namespace App\Fixture\System;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Tenant\Fixture\Tenant;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class TenantFixture
 */
final class TenantFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use Tenant;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/system/tenant.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 0;
    }
}
