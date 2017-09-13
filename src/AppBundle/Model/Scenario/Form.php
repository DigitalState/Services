<?php

namespace AppBundle\Model\Scenario;

use Ds\Component\Model\Attribute;

/**
 * Class Form
 */
class Form
{
    use Attribute\Id;
    use Attribute\Method;
    use Attribute\Action;
    use Attribute\Type;
    use Attribute\Schema;

    /**
     * @const integer
     */
    const TYPE_FORMIO = 'formio';
    const TYPE_BPM = 'bpm';
    const TYPE_SYMFONY = 'symfony';

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
