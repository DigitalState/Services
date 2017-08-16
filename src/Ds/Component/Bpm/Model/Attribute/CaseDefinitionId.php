<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait CaseDefinitionId
 */
trait CaseDefinitionId
{
    /**
     * @var string
     */
    protected $caseDefinitionId; # region accessors

    /**
     * Set case definition id
     *
     * @param string $caseDefinitionId
     * @return object
     */
    public function setCaseDefinitionId($caseDefinitionId)
    {
        $this->caseDefinitionId = $caseDefinitionId;

        return $this;
    }

    /**
     * Get case definition id
     *
     * @return string
     */
    public function getCaseDefinitionId()
    {
        return $this->caseDefinitionId;
    }

    # endregion
}
