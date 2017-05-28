<?php

namespace Ds\Component\Bpm\Query\Attribute;

/**
 * Trait Variables
 */
trait Variables
{
    /**
     * @var array
     */
    protected $variables; # region accessors

    /**
     * Set variables
     *
     * @param array $variables
     * @return object
     */
    public function setVariables($variables)
    {
        $this->variables = $variables;
        $this->_variables = true;

        return $this;
    }

    /**
     * Get variables
     *
     * @return array
     */
    public function getVariables()
    {
        return $this->variables;
    }

    # endregion

    /**
     * @var boolean
     */
    protected $_variables;
}
