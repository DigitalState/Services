<?php

namespace Ds\Component\Bpm\Service;

use Ds\Component\Bpm\Query\ProcessInstanceParameters;

/**
 * Interface ProcessInstanceService
 */
interface ProcessInstanceService extends Service
{
    /**
     * Get process instance list
     *
     * @param \Ds\Component\Bpm\Query\ProcessInstanceParameters $parameters
     * @return array
     */
    public function getList(ProcessInstanceParameters $parameters = null);

    /**
     * Get process instance count
     *
     * @param \Ds\Component\Bpm\Query\ProcessInstanceParameters $parameters
     * @return integer
     */
    public function getCount(ProcessInstanceParameters $parameters = null);

    /**
     * Get process instance
     *
     * @param string $id
     */
    public function get($id);
}
