<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait Components
 */
trait Components
{
    /**
     * @var array
     */
    protected $components; # region accessors

    /**
     * Set components
     *
     * @param array $components
     * @return object
     */
    public function setComponents(array $components)
    {
        $this->components = $components;

        return $this;
    }

    /**
     * Get components
     *
     * @return array
     */
    public function getComponents()
    {
        return $this->components;
    }

    # endregion
}
