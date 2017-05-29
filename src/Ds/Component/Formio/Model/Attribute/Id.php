<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait Id
 */
trait Id
{
    /**
     * @var string
     */
    protected $id; # region accessors

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

    # endregion
}
