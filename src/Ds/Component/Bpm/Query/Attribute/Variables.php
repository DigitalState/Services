<?php

namespace Ds\Component\Bpm\Query\Attribute;

use Ds\Component\Bpm\Model\Variable;

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
    public function setVariables(array $variables)
    {
        $this->variables = [];

        foreach ($variables as $variable) {
            $this->addVariable($variable);
        }

        return $this;
    }

    /**
     * Add variable
     *
     * @param \Ds\Component\Bpm\Model\Variable $variable
     * @return object
     */
    public function addVariable(Variable $variable)
    {
        $this->variables[] = $variable;
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
