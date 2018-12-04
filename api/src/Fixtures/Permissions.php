<?php

namespace App\Fixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Acl\Fixture\Permission;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class Permissions
 */
final class Permissions implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use Permission;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/access/*/permissions.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 11;
    }
}
