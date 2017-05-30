<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait External ids
 */
trait ExternalIds
{
    /**
     * @var array
     */
    protected $externalIds; # region accessors

    /**
     * Set external ids
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
     * Get external ids
     *
     * @return array
     */
    public function getExternalIds()
    {
        return $this->externalIds;
    }

    # endregion
}
