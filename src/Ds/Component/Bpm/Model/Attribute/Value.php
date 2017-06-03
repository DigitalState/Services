<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait Value
 */
trait Value
{
    /**
     * @var string
     */
    protected $value; # region accessors

    /**
     * Set value
     *
     * @param string $value
     * @return object
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    # endregion
}
