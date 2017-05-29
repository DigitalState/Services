<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait Created
 */
trait Created
{
    /**
     * @var string
     */
    protected $created; # region accessors

    /**
     * Set created
     *
     * @param string $created
     * @return object
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    # endregion
}
