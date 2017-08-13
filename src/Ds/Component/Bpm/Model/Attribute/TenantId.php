<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait TenantId
 */
trait TenantId
{
    /**
     * @var string
     */
    protected $tenantId; # region accessors

    /**
     * Set tenant id
     *
     * @param string $tenantId
     * @return object
     */
    public function setTenantId($tenantId)
    {
        $this->tenantId = $tenantId;

        return $this;
    }

    /**
     * Get tenant id
     *
     * @return string
     */
    public function getTenantId()
    {
        return $this->tenantId;
    }

    # endregion
}
