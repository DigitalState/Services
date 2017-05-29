<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait Type
 */
trait Type
{
    /**
     * @var string
     */
    protected $type; # region accessors

    /**
     * Set type
     *
     * @param string $type
     * @return object
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    # endregion
}
