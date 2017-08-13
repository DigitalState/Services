<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait DefinitionId
 */
trait DefinitionId
{
    /**
     * @var string
     */
    protected $definitionId; # region accessors

    /**
     * Set definition id
     *
     * @param string $definitionId
     * @return object
     */
    public function setDefinitionId($definitionId)
    {
        $this->definitionId = $definitionId;

        return $this;
    }

    /**
     * Get definition id
     *
     * @return string
     */
    public function getDefinitionId()
    {
        return $this->definitionId;
    }

    # endregion
}
