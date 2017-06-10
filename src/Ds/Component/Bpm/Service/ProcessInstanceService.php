<?php

namespace Ds\Component\Bpm\Service;

use Ds\Component\Bpm\Query\ProcessInstanceParameters as Parameters;

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
    public function getList(Parameters $parameters = null);

    /**
     * Get process instance count
     *
     * @param \Ds\Component\Bpm\Query\ProcessInstanceParameters $parameters
     * @return integer
     */
    public function getCount(Parameters $parameters = null);

    /**
     * Get process instance
     *
     * @param string $id
     * @param \Ds\Component\Bpm\Query\ProcessInstanceParameters $parameters
     */
    public function get($id, Parameters $parameters = null);
}
