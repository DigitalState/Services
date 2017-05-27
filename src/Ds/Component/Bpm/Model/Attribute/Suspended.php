<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait Suspended
 */
trait Suspended
{
    /**
     * @var boolean
     */
    protected $suspended; # region accessors

    /**
     * Set suspended
     *
     * @param boolean $suspended
     * @return object
     */
    public function setSuspended($suspended)
    {
        $this->suspended = $suspended;

        return $this;
    }

    /**
     * Get suspended
     *
     * @return boolean
     */
    public function getSuspended()
    {
        return $this->suspended;
    }

    # endregion
}
