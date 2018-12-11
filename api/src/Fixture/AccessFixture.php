<?php

namespace App\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Acl\Fixture\Access;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class AccessFixture
 */
final class AccessFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use Access;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/access/*/access.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }
}
