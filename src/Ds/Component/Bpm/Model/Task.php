<?php

namespace Ds\Component\Bpm\Model;

use stdClass;

/**
 * Class Task
 */
class Task implements Model
{
    use Attribute\Id;
    use Attribute\Name;
    use Attribute\Variables;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->variables = new stdClass;
    }
}
