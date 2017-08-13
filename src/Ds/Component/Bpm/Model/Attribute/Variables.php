<?php

namespace Ds\Component\Bpm\Model\Attribute;

use stdClass;

/**
 * Trait Variables
 */
trait Variables
{
    /**
     * @var \stdClass
     */
    protected $variables; # region accessors

    /**
     * Set variables
     *
     * @param \stdClass $variables
     * @return object
     */
    public function setVariables(stdClass $variables)
    {
        $this->variables = $variables;

        return $this;
    }

    /**
     * Get variables
     *
     * @return \stdClass
     */
    public function getVariables()
    {
        return $this->variables;
    }

    # endregion
}
