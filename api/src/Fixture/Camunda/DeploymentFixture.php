<?php

namespace App\Fixture\Camunda;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Camunda\Fixture\Camunda\Deployment;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class DeploymentFixture
 */
final class DeploymentFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use Deployment;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/camunda/deployment.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 30;
    }
}
