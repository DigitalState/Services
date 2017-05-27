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
     * Set tenantId
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
     * Get tenantId
     *
     * @return string
     */
    public function getTenantId()
    {
        return $this->tenantId;
    }

    # endregion
}
