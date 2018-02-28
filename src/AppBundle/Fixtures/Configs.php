<?php

namespace AppBundle\Fixtures;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Config\Fixture\ConfigFixture;

/**
 * Class Configs
 */
class Configs extends ConfigFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/configs.yml';
    }
}
