<?php

namespace Ds\Component\Bpm\Model\Attribute;

use DateTime;

/**
 * Trait FollowUp
 */
trait FollowUp
{
    /**
     * @var \DateTime
     */
    protected $followUp; # region accessors

    /**
     * Set follow up
     *
     * @param \DateTime $followUp
     * @return object
     */
    public function setFollowUp(DateTime $followUp)
    {
        $this->followUp = $followUp;

        return $this;
    }

    /**
     * Get follow up
     *
     * @return \DateTime
     */
    public function getFollowUp()
    {
        return $this->followUp;
    }

    # endregion
}
