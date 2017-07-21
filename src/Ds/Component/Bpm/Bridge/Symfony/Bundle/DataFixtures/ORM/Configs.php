<?php

namespace Ds\Component\Bpm\Bridge\Symfony\Bundle\DataFixtures\ORM;

use Ds\Component\Config\Fixture\ORM\ConfigFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Configs
 */
class Configs extends ConfigFixture implements OrderedFixtureInterface
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
        return __DIR__.'/../../Resources/data/{env}/configs.yml';
    }
}
