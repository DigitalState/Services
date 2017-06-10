<?php

namespace Ds\Component\Bpm\Service;

use Ds\Component\Bpm\Query\ProcessDefinitionParameters as Parameters;

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
    public function getList(Parameters $parameters = null);

    /**
     * Get process definition count
     *
     * @param \Ds\Component\Bpm\Query\ProcessDefinitionParameters $parameters
     * @return integer
     */
    public function getCount(Parameters $parameters = null);

    /**
     * Get process definition
     *
     * @param string $id
     * @param \Ds\Component\Bpm\Query\ProcessDefinitionParameters $parameters
     * @return \Ds\Component\Bpm\Model\ProcessDefinition
     */
    public function get($id, Parameters $parameters = null);

    /**
     * Start a process definition
     *
     * @param string $id
     * @param \Ds\Component\Bpm\Query\ProcessDefinitionParameters $parameters
     * @return \Ds\Component\Bpm\Model\ProcessInstance
     */
    public function start($id, Parameters $parameters = null);

    /**
     * Get start form
     *
     * @param string $id
     * @return
     */
    public function getStartForm($id);
}
