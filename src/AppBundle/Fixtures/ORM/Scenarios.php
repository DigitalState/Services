<?php

namespace AppBundle\Fixtures\ORM;

use AppBundle\Fixture\ORM\ScenarioFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Scenarios
 */
class Scenarios extends ScenarioFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 11;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/scenarios.yml';
    }
}
