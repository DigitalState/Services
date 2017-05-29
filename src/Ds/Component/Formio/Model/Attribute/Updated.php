<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait Updated
 */
trait Updated
{
    /**
     * @var string
     */
    protected $updated; # region accessors

    /**
     * Set updated
     *
     * @param string $updated
     * @return object
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return string
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    # endregion
}
