<?php

namespace AppBundle\Validator\Constraints\Scenario\Config;

use Symfony\Component\Validator\Constraint;

/**
 * Class Valid
 *
 * @Annotation
 */
class Valid extends Constraint
{
    /**
     * @var string
     */
    public $missing = 'Config object is missing attribute {{ attribute }}.';

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
