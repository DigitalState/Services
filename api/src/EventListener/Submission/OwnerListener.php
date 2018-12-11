<?php

namespace App\EventListener\Submission;

use App\Entity\Submission;

/**
 * Class OwnerListener
 */
final class OwnerListener
{
    /**
     * Assign an owner to the submission if none is provided
     *
     * @param \App\Entity\Submission $submission
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
