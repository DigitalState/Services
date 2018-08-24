<?php

namespace AppBundle\Fixtures;

use AppBundle\Fixture\CategoryFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Categories
 */
class Categories extends CategoryFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 21;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/categories.yml';
    }
}
