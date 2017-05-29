<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait ExternalIds
 */
trait ExternalIds
{
    /**
     * @var array
     */
    protected $externalIds; # region externalIdsors

    /**
     * Set externalIds
     *
     * @param array $externalIds
     * @return object
     */
    public function setExternalIds(array $externalIds)
    {
        $this->externalIds = $externalIds;

        return $this;
    }

    /**
     * Get externalIds
     *
     * @return array
     */
    public function getExternalIds()
    {
        return $this->externalIds;
    }

    # endregion
}
