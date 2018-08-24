<?php

namespace AppBundle\EventListener\Submission;

use AppBundle\Entity\Submission;

/**
 * Class OwnerListener
 */
class OwnerListener
{
    /**
     * Assign an owner to the submission if none is provided
     *
     * @param \AppBundle\Entity\Submission $submission
     */
    public function prePersist(Submission $submission)
    {
        if (null !== $submission->getOwner()) {
            return;
        }

        $scenario = $submission->getScenario();
        $submission
            ->setOwner($scenario->getOwner())
            ->setOwnerUuid($scenario->getOwnerUuid());
    }
}
