<?php

namespace Ds\Component\Bpm\Model;

/**
 * Class ProcessInstance
 */
class ProcessInstance implements Model
{
    use Attribute\Id;
    use Attribute\DefinitionId;
    use Attribute\BusinessKey;
    use Attribute\CaseInstanceId;
    use Attribute\Ended;
    use Attribute\Suspended;
    use Attribute\TenantId;
    use Attribute\Links;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->links = [];
    }
}
