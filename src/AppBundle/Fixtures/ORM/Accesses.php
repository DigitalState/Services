<?php

namespace AppBundle\Fixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Security\Fixture\ORM\AccessFixture;

/**
 * Class Accesses
 */
class Accesses extends AccessFixture implements OrderedFixtureInterface
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
        return '/srv/api-platform/src/AppBundle/Resources/data/{env}/*/accesses.yml';
    }
}
