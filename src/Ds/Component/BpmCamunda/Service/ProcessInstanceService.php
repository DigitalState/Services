<?php

namespace Ds\Component\BpmCamunda\Service;

use Ds\Component\Bpm\Service;
use Ds\Component\Bpm\Model\ProcessInstance;
use Ds\Component\Bpm\Query\ProcessInstanceParameters as Parameters;

/**
 * Class ProcessInstanceService
 */
class ProcessInstanceService extends Service\AbstractService implements Service\ProcessInstanceService
{
    /**
     * @const string
     */
    const MODEL = ProcessInstance::class;

    /**
     * @var array
     */
    protected static $map = [
        'id',
        'definitionId',
        'businessKey',
        'ended',
        'suspended',
        'tenantId',
        'caseInstanceId',
        'links'
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
    public function get($id, Parameters $parameters = null)
    {

    }
}
