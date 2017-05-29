<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait MachineName
 */
trait MachineName
{
    /**
     * @var string
     */
    protected $machineName; # region accessors

    /**
     * Set machineName
     *
     * @param string $machineName
     * @return object
     */
    public function setMachineName($machineName)
    {
        $this->machineName = $machineName;

        return $this;
    }

    /**
     * Get machineName
     *
     * @return string
     */
    public function getMachineName()
    {
        return $this->machineName;
    }

    # endregion
}
