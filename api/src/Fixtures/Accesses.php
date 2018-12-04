<?php

namespace App\Fixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Acl\Fixture\Access;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class Accesses
 */
final class Accesses implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use Access;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/access/*/accesses.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }
}
