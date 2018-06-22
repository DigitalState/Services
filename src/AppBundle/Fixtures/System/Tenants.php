<?php

namespace AppBundle\Fixtures\System;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Tenant\Fixture\TenantFixture;

/**
 * Class Tenants
 */
class Tenants extends TenantFixture implements OrderedFixtureInterface
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
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/system/tenants.yml';
    }
}
