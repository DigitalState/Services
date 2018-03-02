<?php

namespace AppBundle\Fixtures\Formio;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ds\Component\Formio\Fixture\Formio\FormFixture;

/**
 * Class Forms
 */
class Forms extends FormFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 20;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/formio/forms.yml';
    }
}
