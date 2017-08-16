<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait TaskDefinitionKey
 */
trait TaskDefinitionKey
{
    /**
     * @var string
     */
    protected $taskDefinitionKey; # region accessors

    /**
     * Set task definition key
     *
     * @param string $taskDefinitionKey
     * @return object
     */
    public function setTaskDefinitionKey($taskDefinitionKey)
    {
        $this->taskDefinitionKey = $taskDefinitionKey;

        return $this;
    }

    /**
     * Get task definition key
     *
     * @return string
     */
    public function getTaskDefinitionKey()
    {
        return $this->taskDefinitionKey;
    }

    # endregion
}
