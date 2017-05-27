<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait Ended
 */
trait Ended
{
    /**
     * @var boolean
     */
    protected $ended; # region accessors

    /**
     * Set ended
     *
     * @param boolean $ended
     * @return object
     */
    public function setEnded($ended)
    {
        $this->ended = $ended;

        return $this;
    }

    /**
     * Get ended
     *
     * @return boolean
     */
    public function getEnded()
    {
        return $this->ended;
    }

    # endregion
}
