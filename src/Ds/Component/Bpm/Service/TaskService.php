<?php

namespace Ds\Component\Bpm\Service;

use Ds\Component\Bpm\Query\TaskParameters as Parameters;

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
    public function getList(Parameters $parameters = null);

    /**
     * Get task count
     *
     * @param \Ds\Component\Bpm\Query\TaskParameters $parameters
     * @return integer
     */
    public function getCount(Parameters $parameters = null);

    /**
     * Get task
     *
     * @param string $id
     * @param \Ds\Component\Bpm\Query\TaskParameters $parameters
     */
    public function get($id, Parameters $parameters = null);
}
