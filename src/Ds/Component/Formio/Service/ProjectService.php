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
     * @var array
     */
    protected static $map = [
        'id' => '_id',
        'updated' => 'modified',
        'title'
    ];

    /**
     * Cast object to model
     *
     * @param \stdClass $object
     * @return \Ds\Component\Formio\Model\Project
     */
    public static function toModel(stdClass $object)
    {
        $model = new Project;

        foreach (static::$map as $local => $remote) {
            if (is_int($local)) {
                $local = $remote;
            }

            if (property_exists($object, $remote)) {
                $model->{'set'.ucfirst($local)}($object->$remote);
            }
        }

        return $model;
    }

    /**
     * Cast model to object
     *
     * @param \Ds\Component\Formio\Model\Project $model
     * @return stdClass
     */
    public static function toStdClass(Project $model)
    {
        $object = new stdClass;

        foreach (static::$map as $local => $remote) {
            if (is_int($local)) {
                $local = $remote;
            }

            if (property_exists($model, $remote)) {
                $object->$remote = $model->{'get'.ucfirst($local)}();
            }
        }

        return $object;
    }
}
