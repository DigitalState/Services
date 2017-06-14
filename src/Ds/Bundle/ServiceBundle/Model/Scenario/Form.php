<?php

namespace Ds\Bundle\ServiceBundle\Model\Scenario;

use Ds\Component\Model\Attribute;

/**
 * Class Form
 */
class Form
{
    use Attribute\Type;
    use Attribute\Schema;

    /**
     * @const integer
     */
    const TYPE_FORMIO = 'formio';

    /**
     * Typecast to object
     *
     * @return \stdClass
     */
    public function toObject()
    {
        return (object) get_object_vars($this);
    }
}
