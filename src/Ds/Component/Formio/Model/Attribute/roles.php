<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait Roles
 */
trait Roles
{
    /**
     * @var array
     */
    protected $roles; # region accessors

    /**
     * Set roles
     *
     * @param array $roles
     * @return object
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    # endregion
}
