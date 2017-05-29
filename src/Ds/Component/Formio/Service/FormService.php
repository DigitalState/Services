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

    /**
     * Cast object to model
     *
     * @param stdClass $item
     * @return \Ds\Component\Formio\Model\Form
     */
    public static function toModel(stdClass $item)
    {
        $model = new Form;
        $properties = [
            'id' => '_id',
            'updated' => 'modified',
            'title',
            'display',
            'type',
            'name',
            'path'
        ];

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
     * {@inheritdoc}
     */
    public function get($id)
    {
        //$item = $this->execute('GET', str_replace('{id}', $id, static::RESOURCE_ITEM));
        $item = $this->execute('GET', 'http://www.mocky.io/v2/592b7a27100000b10e38977b');
        $model = static::toModel($item);

        return $model;
    }
}
