<?php

namespace AppBundle\Fixtures\ORM;

use AppBundle\Fixture\ORM\CategoryFixture;
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
        return 11;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/categories.yml';
    }
}
