<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait ParentTaskId
 */
trait ParentTaskId
{
    /**
     * @var string
     */
    protected $parentTaskId; # region accessors

    /**
     * Set parent task id
     *
     * @param string $parentTaskId
     * @return object
     */
    public function setParentTaskId($parentTaskId)
    {
        $this->parentTaskId = $parentTaskId;

        return $this;
    }

    /**
     * Get parent task id
     *
     * @return string
     */
    public function getParentTaskId()
    {
        return $this->parentTaskId;
    }

    # endregion
}
