<?php

namespace Ds\Bundle\ServiceBundle\EventListener\Submission;

use Ds\Bundle\ServiceBundle\Entity\Submission;

/**
 * Class HandlerListener
 */
class HandlerListener
{
    /**
     * Pre persist
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Submission $submission
     */
    public function prePersist(Submission $submission)
    {
        if (null !== $submission->getHandler()) {
            return;
        }

        $service = $submission->getService();
        $submission
            ->setHandler($service->getHandler())
            ->setHandlerUuid($service->getHandlerUuid());
    }
}
