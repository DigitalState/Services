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
     * Cast object to model
     *
     * @param stdClass $item
     * @return \Ds\Component\Formio\Model\Project
     */
    public static function toModel(stdClass $item)
    {
        $model = new Project;
        $properties = [
            'id' => '_id',
            'updated' => 'modified',
            'title'
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
}
