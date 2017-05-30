<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait Data
 */
trait Data
{
    /**
     * @var array
     */
    protected $data; # region accessors

    /**
     * Set data
     *
     * @param array $data
     * @return object
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    # endregion
}
