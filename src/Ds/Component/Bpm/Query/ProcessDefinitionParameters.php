<?php

namespace Ds\Component\Bpm\Query;

/**
 * Class ProcessDefinitionParameters
 */
class ProcessDefinitionParameters extends AbstractParameters
{
    use Attribute\Name;
    use Attribute\Key;
    use Attribute\Variables;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->variables = [];
    }
}
