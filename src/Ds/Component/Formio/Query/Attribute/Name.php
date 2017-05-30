<?php

namespace Ds\Component\Formio\Query\Attribute;

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
        $this->_name = true;

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

    /**
     * @var boolean
     */
    protected $_name;
}
