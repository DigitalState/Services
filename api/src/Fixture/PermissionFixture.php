<?php

namespace App\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Acl\Fixture\Permission;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class PermissionFixture
 */
final class PermissionFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use Permission;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/access/*/permission.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 11;
    }
}
