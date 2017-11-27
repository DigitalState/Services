<?php

namespace AppBundle\Fixtures\ORM;

use AppBundle\Fixture\ORM\ServiceFixture;
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
        return '/srv/api-platform/src/AppBundle/Resources/data/{env}/services.yml';
    }
}
