<?php

namespace AppBundle\Model;

/**
 * Class Data
 */
class Data
{
    /**
     * Get property
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            return null;
        }
    }

    /**
     * Set property
     *
     * @param string $property
     * @param mixed $value
     * @return object
     */
    public function __set($property, $value)
    {
        $this->$property = $value;

        return $this;
    }
}
