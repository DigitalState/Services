<?php

namespace Ds\Component\BpmCamunda\Service;

use Ds\Component\Bpm\Service;
use Ds\Component\Bpm\Query\ProcessDefinitionParameters as Parameters;
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
    const MODEL = ProcessDefinition::class;

    /**
     * @const string
     */
    const RESOURCE_LIST = '/process-definition';
    const RESOURCE_COUNT = '/process-definition/count';
    const RESOURCE_ITEM = '/process-definition/{id}';
    const RESOURCE_ITEM_START = '/process-definition/{id}/start';
    const RESOURCE_ITEM_START_FORM = '/process-definition/{id}/startForm';

    /**
     * @var array
     */
    protected static $map = [
        'id',
        'key',
        'name',
        'description',
        'category',
        'resource',
        'deploymentId',
        'diagram',
        'tenantId',
        'version',
        'versionTag'
    ];

    /**
     * {@inheritdoc}
     */
    public function getList(Parameters $parameters = null)
    {
        $items = $this->execute('GET', static::RESOURCE_LIST);
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
    public function getCount(Parameters $parameters = null)
    {
        $result = $this->execute('GET', static::RESOURCE_COUNT);

        return $result->count;
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        $resource = str_replace('{id}', $id, static::RESOURCE_ITEM);
        $item = $this->execute('GET', $resource);
        $model = static::toModel($item);

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    public function start($id, Parameters $parameters = null)
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
        $resource = str_replace('{id}', $id, static::RESOURCE_ITEM_START_FORM);
        $result = $this->execute('GET', $resource);

        return $result->key;
    }
}
