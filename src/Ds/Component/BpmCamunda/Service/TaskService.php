<?php

namespace Ds\Component\BpmCamunda\Service;

use Ds\Component\Bpm\Service;
use Ds\Component\Bpm\Model\Task;
use Ds\Component\Bpm\Query\TaskParameters;

/**
 * Class TaskService
 */
class TaskService extends Service\AbstractService implements Service\TaskService
{
    /**
     * @const string
     */
    const MODEL = Task::class;

    /**
     * @var array
     */
    protected static $map = [
    ];

    /**
     * {@inheritdoc}
     */
    public function getList(TaskParameters $parameters = null)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getCount(TaskParameters $parameters = null)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {

    }
}
