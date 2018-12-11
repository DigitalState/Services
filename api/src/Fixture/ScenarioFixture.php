<?php

namespace App\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Metadata\Fixture\Metadata;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class ScenarioFixture
 */
final class ScenarioFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use Scenario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/scenario.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 21;
    }
}
