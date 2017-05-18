<?php

namespace Ds\Bundle\ServiceBundle\Accessor;

use Ds\Bundle\ServiceBundle\Entity\Service as ServiceEntity;

/**
 * Trait Service
 */
trait Service
{
    /**
     * Set service
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Service $service
     * @return object
     */
    public function setService(ServiceEntity $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \Ds\Bundle\ServiceBundle\Entity\Service
     */
    public function getService()
    {
        return $this->service;
    }
}
