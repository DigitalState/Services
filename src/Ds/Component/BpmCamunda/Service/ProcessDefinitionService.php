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
    const RESOURCE_OBJECT = '/process-definition/{id}';
    const RESOURCE_OBJECT_START = '/process-definition/{id}/start';
    const RESOURCE_OBJECT_START_FORM = '/process-definition/{id}/startForm';

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
        $objects = $this->execute('GET', static::RESOURCE_LIST);
        $list = [];

        foreach ($objects as $object) {
            $model = static::toModel($object);
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
        $resource = str_replace('{id}', $id, static::RESOURCE_OBJECT);
        $object = $this->execute('GET', $resource);
        $model = static::toModel($object);

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    public function start($id, Parameters $parameters = null)
    {
        $resource = str_replace('{id}', $id, static::RESOURCE_OBJECT_START);
        $options = [];

        if ($parameters) {
            $options['form_params'] = (array) $parameters->toObject(true);
        }

        $object = $this->execute('POST', $resource, $options);
        $model = ProcessInstanceService::toModel($object);

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    public function getStartForm($id)
    {
        $resource = str_replace('{id}', $id, static::RESOURCE_OBJECT_START_FORM);
        $result = $this->execute('GET', $resource);

        return $result->key;
    }
}
