<?php

namespace App\Fixtures\System;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Parameter\Fixture\Parameter;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class Parameters
 */
final class Parameters implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use Parameter;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/system/parameters.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 0;
    }
}
