<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait Version
 */
trait Version
{
    /**
     * @var integer
     */
    protected $version; # region accessors

    /**
     * Set version
     *
     * @param integer $version
     * @return object
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    # endregion
}
