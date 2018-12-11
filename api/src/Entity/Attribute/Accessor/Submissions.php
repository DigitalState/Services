<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\Submission;

/**
 * Trait Submissions
 */
trait Submissions
{
    /**
     * Add submission
     *
     * @param \App\Entity\Submission $submission
     * @return object
     */
    public function addSubmission(Submission $submission)
    {
        if (!$this->submissions->contains($submission)) {
            $this->submissions->add($submission);
        }

        return $this;
    }

    /**
     * Remove submission
     *
     * @param \App\Entity\Submission $submission
     * @return object
     */
    public function removeSubmission(Submission $submission)
    {
        if ($this->submissions->contains($submission)) {
            $this->submissions->removeElement($submission);
        }

        return $this;
    }

    /**
     * Get submissions
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getSubmissions()
    {
        return $this->submissions;
    }
}
