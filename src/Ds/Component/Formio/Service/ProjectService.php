<?php

namespace Ds\Component\Formio\Service;

use Ds\Component\Formio\Model\Project;
use stdClass;

/**
 * Class ProjectService
 */
class ProjectService extends AbstractService
{

    /**
     * API Resource <--> Model property mapping
     * @return array
     */
    public static function getMap() {
        return [
            'id' => '_id',
            'updated' => 'modified',
            'title'
        ];
    }

    /**
     * Cast object to model
     *
     * @param stdClass $item
     * @return \Ds\Component\Formio\Model\Project
     */
    public static function toModel(stdClass $item)
    {
        $model = new Project;
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
}
