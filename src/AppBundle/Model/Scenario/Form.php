<?php

namespace AppBundle\Model\Scenario;

use AppBundle\Model\Attribute;
use Ds\Component\Model\Attribute as ModelAttribute;

/**
 * Class Form
 */
class Form
{
    use Attribute\Id;
    use Attribute\Method;
    use Attribute\Action;
    use ModelAttribute\Type;
    use ModelAttribute\Schema;

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
