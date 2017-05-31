<?php

namespace Ds\Component\Formio\Model\Attribute;

use stdClass;

/**
 * Trait Data
 */
trait Data
{
    /**
     * @var \stdClass
     */
    protected $data; # region accessors

    /**
     * Set data
     *
     * @param stdClass $data
     * @return object
     */
    public function setData(stdClass $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return stdClass
     */
    public function getData()
    {
        return $this->data;
    }

    # endregion
}
