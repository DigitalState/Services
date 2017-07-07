<?php

namespace AppBundle\Model\Attribute\Accessor;

/**
 * Trait Method
 */
trait Method
{
    /**
     * Set method
     *
     * @param string $method
     * @return object
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }
}
