<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait VersionTag
 */
trait VersionTag
{
    /**
     * @var string
     */
    protected $versionTag; # region accessors

    /**
     * Set versionTag
     *
     * @param string $versionTag
     * @return object
     */
    public function setVersionTag($versionTag)
    {
        $this->versionTag = $versionTag;

        return $this;
    }

    /**
     * Get versionTag
     *
     * @return string
     */
    public function getVersionTag()
    {
        return $this->versionTag;
    }

    # endregion
}
