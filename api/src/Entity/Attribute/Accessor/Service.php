<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\Service as ServiceEntity;

/**
 * Trait Service
 */
trait Service
{
    /**
     * Set service
     *
     * @param \App\Entity\Service $service
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
     * @return \App\Entity\Service
     */
    public function getService()
    {
        return $this->service;
    }
}
