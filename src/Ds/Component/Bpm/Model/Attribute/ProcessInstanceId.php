<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait ProcessInstanceId
 */
trait ProcessInstanceId
{
    /**
     * @var string
     */
    protected $processInstanceId; # region accessors

    /**
     * Set process instance id
     *
     * @param string $processInstanceId
     * @return object
     */
    public function setProcessInstanceId($processInstanceId)
    {
        $this->processInstanceId = $processInstanceId;

        return $this;
    }

    /**
     * Get process instance id
     *
     * @return string
     */
    public function getProcessInstanceId()
    {
        return $this->processInstanceId;
    }

    # endregion
}
