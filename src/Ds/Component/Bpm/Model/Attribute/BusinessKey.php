<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait BusinessKey
 */
trait BusinessKey
{
    /**
     * @var string
     */
    protected $businessKey; # region accessors

    /**
     * Set business key
     *
     * @param string $businessKey
     * @return object
     */
    public function setBusinessKey($businessKey)
    {
        $this->businessKey = $businessKey;

        return $this;
    }

    /**
     * Get business key
     *
     * @return string
     */
    public function getBusinessKey()
    {
        return $this->businessKey;
    }

    # endregion
}
