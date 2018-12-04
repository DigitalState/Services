<?php

namespace App\Fixtures\System;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Tenant\Fixture\Tenant;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class Tenants
 */
final class Tenants implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use Tenant;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/system/tenants.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 0;
    }
}
