<?php

namespace Ds\Component\Bpm\Service;

use Ds\Component\Bpm\Query\TaskParameters;

/**
 * Interface TaskService
 */
interface TaskService extends Service
{
    /**
     * Get task list
     *
     * @param \Ds\Component\Bpm\Query\TaskParameters $parameters
     * @return array
     */
    public function getList(TaskParameters $parameters = null);

    /**
     * Get task count
     *
     * @param \Ds\Component\Bpm\Query\TaskParameters $parameters
     * @return integer
     */
    public function getCount(TaskParameters $parameters = null);

    /**
     * Get task
     *
     * @param string $id
     */
    public function get($id);
}
