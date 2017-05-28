<?php

namespace Ds\Component\Bpm\Api;

/**
 * Class Api
 */
class Api
{
    /**
     * @var \Ds\Component\Bpm\Service\ProcessDefinitionService
     */
    public $processDefinition;

    /**
     * @var \Ds\Component\Bpm\Service\ProcessInstanceService
     */
    public $processInstance;

    /**
     * @var \Ds\Component\Bpm\Service\TaskService
     */
    public $task;
}
