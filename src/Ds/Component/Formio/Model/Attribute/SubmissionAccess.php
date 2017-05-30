<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait SubmissionAccess
 */
trait SubmissionAccess
{
    /**
     * @var array
     */
    protected $submissionAccess; # region accessors

    /**
     * Set submission access
     *
     * @param array $submissionAccess
     * @return object
     */
    public function setSubmissionAccess(array $submissionAccess)
    {
        $this->submissionAccess = $submissionAccess;

        return $this;
    }

    /**
     * Get submission access
     *
     * @return array
     */
    public function getSubmissionAccess()
    {
        return $this->submissionAccess;
    }

    # endregion
}
