<?php

namespace Ds\Component\Formio\Service;

use Ds\Component\Formio\Model\Submission;
use stdClass;

/**
 * Class SubmissionService
 */
class SubmissionService extends AbstractService
{
    /**
     * Cast object to model
     *
     * @param stdClass $item
     * @return \Ds\Component\Formio\Model\Submission
     */
    public static function toModel(stdClass $item)
    {
        $model = new Submission;
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
