<?php

namespace Ds\Component\Bpm\Model\Attribute;

use DateTime;

/**
 * Trait Created
 */
trait Created
{
    /**
     * @var \DateTime
     */
    protected $created; # region accessors

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return object
     */
    public function setCreated(DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    # endregion
}
