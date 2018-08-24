<?php

namespace AppBundle\Fixtures;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Metadata\Fixture\MetadataFixture;

/**
 * Class Metadatas
 */
class Metadatas extends MetadataFixture implements OrderedFixtureInterface
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
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/metadatas.yml';
    }
}
