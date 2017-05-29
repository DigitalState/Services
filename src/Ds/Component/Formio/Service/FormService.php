<?php

namespace Ds\Component\Formio\Service;

use Ds\Component\Formio\Model\Form;
use stdClass;

/**
 * Class FormService
 */
class FormService extends AbstractService
{
    /**
     * @const string
     */
    const RESOURCE_LIST = '/form';
    const RESOURCE_ITEM = '/form/{id}';
    const RESOURCE_ITEM_BY_FIELD = '/form?{fieldName}={fieldValue}';

    /**
     * API Resource <--> Model property mapping
     * @return array
     */
    public static function getMap() {
        return [
            'id' => '_id',
            'updated' => 'modified',
            'created',
            'title',
            'display',
            'type',
            'name',
            'path',
            'components',
            'tags',
            'access',
            'roles',
            'owner',
        ];
    }
    
    /**
     * Cast object to model
     *
     * @param stdClass $item
     * @return \Ds\Component\Formio\Model\Form
     */
    public static function toModel(stdClass $item)
    {
        $model = new Form;
        $properties = static::getMap();

        foreach ($properties as $local => $remote) {
            if (is_int($local)) {
                $local = $remote;
            }

            if (property_exists($item, $remote)) {
                $model->{'set'.$local}($item->$remote);
            }
        }

        return $model;
    }

    /**
     * Get form list
     *
     * @return array
     */
    public function getList()
    {
        //$items = $this->execute('GET', static::RESOURCE_LIST);
        $items = $this->execute('GET', 'http://www.mocky.io/v2/592b798d100000b10e389778');
        $list = [];

        foreach ($items as $item) {
            $model = static::toModel($item);
            $list[] = $model;
        }

        return $list;
    }

    /**
     * Get form
     *
     * @param string $id
     * @return \Ds\Component\Formio\Model\Form
     */
    public function get($id)
    {
        //$item = $this->execute('GET', str_replace('{id}', $id, static::RESOURCE_ITEM));
        $item = $this->execute('GET', 'http://www.mocky.io/v2/592b7a27100000b10e38977b');
        $model = static::toModel($item);

        return $model;
    }

    /**
     * Get form by an arbitrary field
     *
     * @param string $fieldName
     * @param string $fieldValue
     * @return \Ds\Component\Formio\Model\Form
     */
    public function getByField($fieldName, $fieldValue)
    {
        //$url = str_replace(['{$fieldName}', '{$fieldValue}'], [$fieldName, $fieldValue], static::RESOURCE_ITEM_BY_FIELD);
        //$item = $this->execute('GET', $url);
        $item = $this->execute('GET', 'http://www.mocky.io/v2/592b7a27100000b10e38977b');
        $model = static::toModel($item);

        return $model;
    }

    /**
     * Get form by name address.
     *
     * @param string $name
     * @return \Ds\Component\Formio\Model\Form
     */
    public function getByName($name)
    {
        return $this->getByField('name', $name);
    }
}
