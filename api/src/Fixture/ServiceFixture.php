<?php

namespace App\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Metadata\Fixture\Metadata;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class ServiceFixture
 */
final class ServiceFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use Service;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/service.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 20;
    }
}
