<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait Access
 */
trait Access
{
    /**
     * @var array
     */
    protected $access; # region accessors

    /**
     * Set access
     *
     * @param array $access
     * @return object
     */
    public function setAccess(array $access)
    {
        $this->access = $access;

        return $this;
    }

    /**
     * Get access
     *
     * @return array
     */
    public function getAccess()
    {
        return $this->access;
    }

    # endregion
}
