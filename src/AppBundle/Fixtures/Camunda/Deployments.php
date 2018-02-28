<?php

namespace AppBundle\Fixtures\Camunda;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Camunda\Fixture\Camunda\DeploymentFixture;

/**
 * Class Deployments
 */
class Deployments extends DeploymentFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 20;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/camunda/deployments.yml';
    }
}
