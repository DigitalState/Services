<?php

namespace Ds\Bundle\ServiceBundle\EventListener\Submission;

use Ds\Bundle\ServiceBundle\Entity\Submission;

/**
 * Class OwnerListener
 */
class OwnerListener
{
    /**
     * Pre persist
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Submission $submission
     */
    public function prePersist(Submission $submission)
    {
        if (null !== $submission->getOwner()) {
            return;
        }

        $service = $submission->getService();
        $submission
            ->setOwner($service->getOwner())
            ->setOwnerUuid($service->getOwnerUuid());
    }
}
