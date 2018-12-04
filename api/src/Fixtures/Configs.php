<?php

namespace App\Fixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Config\Fixture\Config;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class Configs
 */
final class Configs implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use Config;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/configs.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }
}
