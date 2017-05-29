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
    protected $submissionAccess; # region submissionAccessors

    /**
     * Set submissionAccess
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
     * Get submissionAccess
     *
     * @return array
     */
    public function getSubmissionAccess()
    {
        return $this->submissionAccess;
    }

    # endregion
}
