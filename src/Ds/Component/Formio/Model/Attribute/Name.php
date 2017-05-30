<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait Name
 */
trait Name
{
    /**
     * @var string
     */
    protected $name; # region accessors

    /**
     * Set name
     *
     * @param string $name
     * @return object
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    # endregion
}
