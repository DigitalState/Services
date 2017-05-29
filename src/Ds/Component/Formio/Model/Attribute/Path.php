<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait Path
 */
trait Path
{
    /**
     * @var string
     */
    protected $path; # region accessors

    /**
     * Set path
     *
     * @param string $path
     * @return object
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    # endregion
}
