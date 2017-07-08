<?php

namespace AppBundle\DataFixtures\ORM;

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
        return __DIR__.'/../../Resources/data/{server}/scenarios.yml';
    }
}
