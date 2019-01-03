<?php

namespace App\Fixture\Workflow;

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
     *
     * @param string $app
     * @param string $namespace
     */
    public function __construct(string $app, string $namespace)
    {
        $this->app = $app;
        $this->namespace = $namespace;
        $this->path = '/srv/api/config/fixtures/{fixtures}/workflow/deployment.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 30;
    }
}
