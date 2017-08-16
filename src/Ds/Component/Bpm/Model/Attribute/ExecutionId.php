<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait ExecutionId
 */
trait ExecutionId
{
    /**
     * @var string
     */
    protected $executionId; # region accessors

    /**
     * Set execution id
     *
     * @param string $executionId
     * @return object
     */
    public function setExecutionId($executionId)
    {
        $this->executionId = $executionId;

        return $this;
    }

    /**
     * Get execution id
     *
     * @return string
     */
    public function getExecutionId()
    {
        return $this->executionId;
    }

    # endregion
}
