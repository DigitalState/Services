<?php

namespace App\Fixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Metadata\Fixture\Metadata;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class Metadatas
 */
final class Metadatas implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use Metadata;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/metadatas.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }
}
