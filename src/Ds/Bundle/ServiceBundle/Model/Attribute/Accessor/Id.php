<?php

namespace Ds\Bundle\ServiceBundle\Model\Attribute\Accessor;

/**
 * Trait Id
 */
trait Id
{
    /**
     * Set id
     *
     * @param string $id
     * @return object
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
