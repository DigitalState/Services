<?php

namespace Ds\Component\Bpm\Model;

/**
 * Class ProcessInstance
 */
class ProcessInstance
{
    use Attribute\Id;
    use Attribute\DefinitionId;
    use Attribute\BusinessKey;
    use Attribute\CaseInstanceId;
    use Attribute\Ended;
    use Attribute\Suspended;
    use Attribute\TenantId;
}
