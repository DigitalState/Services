<?php

namespace AppBundle\DataFixtures\ORM;

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
        return __DIR__.'/../../Resources/data/{server}/categories.yml';
    }
}
