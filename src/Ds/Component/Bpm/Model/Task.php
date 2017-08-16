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
    use Attribute\Assignee;
    use Attribute\Created;
    use Attribute\Due;
    use Attribute\FollowUp;
    use Attribute\DelegationState;
    use Attribute\Description;
    use Attribute\ExecutionId;
    use Attribute\Owner;
    use Attribute\ParentTaskId;
    use Attribute\Priority;
    use Attribute\ProcessDefinitionId;
    use Attribute\ProcessInstanceId;
    use Attribute\CaseExecutionId;
    use Attribute\CaseDefinitionId;
    use Attribute\CaseInstanceId;
    use Attribute\TaskDefinitionKey;
    use Attribute\FormKey;
    use Attribute\TenantId;
    use Attribute\Variables;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->variables = new stdClass;
    }
}
