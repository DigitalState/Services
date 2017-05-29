<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait Display
 */
trait Display
{
    /**
     * @var string
     */
    protected $display; # region accessors

    /**
     * Set display
     *
     * @param string $display
     * @return object
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /**
     * Get display
     *
     * @return string
     */
    public function getDisplay()
    {
        return $this->display;
    }

    # endregion
}
