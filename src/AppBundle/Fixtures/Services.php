<?php

namespace AppBundle\Fixtures;

use AppBundle\Fixture\ServiceFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Services
 */
class Services extends ServiceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/services.yml';
    }
}
