<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait DelegationState
 */
trait DelegationState
{
    /**
     * @var string
     */
    protected $delegationState; # region accessors

    /**
     * Set delegation state
     *
     * @param string $delegationState
     * @return object
     */
    public function setDelegationState($delegationState)
    {
        $this->delegationState = $delegationState;

        return $this;
    }

    /**
     * Get delegation state
     *
     * @return string
     */
    public function getDelegationState()
    {
        return $this->delegationState;
    }

    # endregion
}
