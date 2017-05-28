<?php

namespace Ds\Component\BpmCamunda\Service;

use Ds\Component\Bpm\Service;
use Ds\Component\Bpm\Query\ProcessDefinitionParameters;
use Ds\Component\Bpm\Model\ProcessDefinition;
use stdClass;

/**
 * Class ProcessDefinitionService
 */
class ProcessDefinitionService extends Service\AbstractService implements Service\ProcessDefinitionService
{
    /**
     * @const string
     */
    const RESOURCE_LIST = '/process-definition';
    const RESOURCE_COUNT = '/process-definition/count';
    const RESOURCE_ITEM = '/process-definition/{id}';
    const RESOURCE_START = '/process-definition/{id}/start';
    const RESOURCE_START_FORM = '/process-definition/{id}/startForm';

    /**
     * Cast object to model
     *
     * @param stdClass $item
     * @return \Ds\Component\Bpm\Model\ProcessDefinition
     */
    public static function toModel(stdClass $item)
    {
        $model = new ProcessDefinition;
        $properties = [
            'id', 'key', 'name', 'description', 'category', 'resource', 'deploymentId',
            'diagram', 'tenantId', 'version', 'versionTag'
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
    public function getList(ProcessDefinitionParameters $parameters = null)
    {
        //$items = $this->execute('GET', static::RESOURCE_LIST);
        $items = $this->execute('GET', 'http://www.mocky.io/v2/592990fa110000bf000828eb', $parameters);
        $list = [];

        foreach ($items as $item) {
            $model = static::toModel($item);
            $list[] = $model;
        }

        return $list;
    }

    /**
     * {@inheritdoc}
     */
    public function getCount(ProcessDefinitionParameters $parameters = null)
    {
        //$result = $this->execute('GET', static::RESOURCE_COUNT);
        $result = $this->execute('GET', 'http://www.mocky.io/v2/5929a2061100008001082903', $parameters);

        return $result->count;
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        //$item = $this->execute('GET', str_replace('{id}', $id, static::RESOURCE_ITEM));
        $item = $this->execute('GET', 'http://www.mocky.io/v2/59299a6b11000029010828fb');
        $model = static::toModel($item);

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    public function start($id, ProcessDefinitionParameters $parameters = null)
    {
        //$item = $this->execute('POST', str_replace('{id}', $id, static::RESOURCE_START));
        $item = $this->execute('POST', 'http://www.mocky.io/v2/5929a4ee1100006c01082909', $parameters);
        $model = ProcessInstanceService::toModel($item);

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    public function getStartForm($id)
    {
        //$result = $this->execute('GET', static::RESOURCE_START_FORM);
        $result = $this->execute('GET', 'http://www.mocky.io/v2/592b4ed8100000e30a389763');

        return $result->key;
    }
}
