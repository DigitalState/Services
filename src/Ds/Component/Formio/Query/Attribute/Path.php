<?php

namespace Ds\Component\Formio\Query\Attribute;

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
        $this->_path = true;

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

    /**
     * @var boolean
     */
    protected $_path;
}
