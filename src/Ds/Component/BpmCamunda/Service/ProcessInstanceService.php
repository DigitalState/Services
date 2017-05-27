<?php

namespace Ds\Component\BpmCamunda\Service;

use Ds\Component\Bpm\Service;
use Ds\Component\Bpm\Model\ProcessInstance;
use Ds\Component\Bpm\Query\ProcessInstanceParameters;
use stdClass;

/**
 * Class ProcessInstanceService
 */
class ProcessInstanceService extends Service\AbstractService implements Service\ProcessInstanceService
{
    /**
     * Cast object to model
     *
     * @param stdClass $item
     * @return \Ds\Component\Bpm\Model\ProcessInstance
     */
    public static function toModel(stdClass $item)
    {
        $model = new ProcessInstance;
        $properties = [
            'id', 'definitionId', 'businessKey', 'ended', 'suspended', 'tenantId', 'caseInstanceId'
        ];

        foreach ($properties as $property) {
            if (property_exists($item, $property)) {
                $model->{'set' . $property}($item->$property);
            }
        }

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(ProcessInstanceParameters $parameters = null)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getCount(ProcessInstanceParameters $parameters = null)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {

    }
}
