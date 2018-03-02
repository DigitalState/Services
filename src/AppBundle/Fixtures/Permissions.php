<?php

namespace AppBundle\Fixtures;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Security\Fixture\PermissionFixture;

/**
 * Class Permissions
 */
class Permissions extends PermissionFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/access/*/permissions.yml';
    }
}
