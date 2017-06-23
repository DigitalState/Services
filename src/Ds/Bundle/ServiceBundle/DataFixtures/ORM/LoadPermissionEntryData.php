<?php

namespace Ds\Bundle\ServiceBundle\DataFixtures\ORM;

use Ds\Component\Security\Fixture\ORM\PermissionEntryFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class LoadPermissionEntryData
 */
class LoadPermissionEntryData extends PermissionEntryFixture implements OrderedFixtureInterface
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
        return __DIR__.'/../../Resources/data/{server}/permission_entries.yml';
    }
}
