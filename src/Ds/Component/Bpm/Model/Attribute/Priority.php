<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait Priority
 */
trait Priority
{
    /**
     * @var integer
     */
    protected $priority; # region accessors

    /**
     * Set priority
     *
     * @param integer $priority
     * @return object
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    # endregion
}
