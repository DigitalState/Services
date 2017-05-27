<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait CaseInstanceId
 */
trait CaseInstanceId
{
    /**
     * @var string
     */
    protected $caseInstanceId; # region accessors

    /**
     * Set caseInstanceId
     *
     * @param string $caseInstanceId
     * @return object
     */
    public function setCaseInstanceId($caseInstanceId)
    {
        $this->caseInstanceId = $caseInstanceId;

        return $this;
    }

    /**
     * Get caseInstanceId
     *
     * @return string
     */
    public function getCaseInstanceId()
    {
        return $this->caseInstanceId;
    }

    # endregion
}
