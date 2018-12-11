<?php

namespace App\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Config\Fixture\Config;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class ConfigFixture
 */
final class ConfigFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use Config;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/config.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }
}
