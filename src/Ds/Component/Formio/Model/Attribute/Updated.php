<?php

namespace Ds\Component\Formio\Model\Attribute;

use DateTime;

/**
 * Trait Updated
 */
trait Updated
{
    /**
     * @var \DateTime
     */
    protected $updated; # region accessors

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return object
     */
    public function setUpdated(DateTime $updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    # endregion
}
