<?php

namespace Ds\Component\BpmCamunda\Service;

use Ds\Component\Bpm\Service;
use Ds\Component\Bpm\Model\Task;
use Ds\Component\Bpm\Query\TaskParameters as Parameters;

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
    public function getList(Parameters $parameters = null)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getCount(Parameters $parameters = null)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {

    }
}
