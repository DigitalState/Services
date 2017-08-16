<?php

namespace Ds\Component\Bpm\Model\Attribute;

use DateTime;

/**
 * Trait Due
 */
trait Due
{
    /**
     * @var \DateTime
     */
    protected $due; # region accessors

    /**
     * Set due
     *
     * @param \DateTime $due
     * @return object
     */
    public function setDue(DateTime $due)
    {
        $this->due = $due;

        return $this;
    }

    /**
     * Get due
     *
     * @return \DateTime
     */
    public function getDue()
    {
        return $this->due;
    }

    # endregion
}
