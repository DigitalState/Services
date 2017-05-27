<?php

namespace Ds\Component\Bpm\Service;

use Ds\Component\Bpm\Query\ProcessDefinitionParameters;

/**
 * Interface ProcessDefinitionService
 */
interface ProcessDefinitionService extends Service
{
    /**
     * Get process definition list
     *
     * @param \Ds\Component\Bpm\Query\ProcessDefinitionParameters $parameters
     * @return array
     */
    public function getList(ProcessDefinitionParameters $parameters = null);

    /**
     * Get process definition count
     *
     * @param \Ds\Component\Bpm\Query\ProcessDefinitionParameters $parameters
     * @return integer
     */
    public function getCount(ProcessDefinitionParameters $parameters = null);

    /**
     * Get process definition
     *
     * @param string $id
     * @return \Ds\Component\Bpm\Model\ProcessDefinition
     */
    public function get($id);

    /**
     * Start a process definition
     *
     * @param string $id
     * @return \Ds\Component\Bpm\Model\ProcessInstance
     */
    public function start($id);
}
