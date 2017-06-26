<?php

namespace Ds\Bundle\ServiceBundle\Model\Attribute\Accessor;

/**
 * Trait Action
 */
trait Action
{
    /**
     * Set action
     *
     * @param string $action
     * @return object
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }
}
