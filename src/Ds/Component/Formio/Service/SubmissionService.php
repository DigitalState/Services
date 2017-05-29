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
     * @const string
     */
    const RESOURCE_LIST = '/{formPath}/submission';
    const RESOURCE_ITEM = '/{formPath}/submission/{submissionId}';

    /**
     * API Resource <--> Model property mapping
     * @return array
     */
    public static function getMap() {
        return [
            'id' => '_id',
            'updated' => 'modified',
            'created',
            'form',
            'data',
            'externalIds',
            'access',
            'roles',
            'owner',
        ];
    }

    /**
     * Cast object to model
     *
     * @param stdClass $item
     * @return \Ds\Component\Formio\Model\Submission
     */
    public static function toModel(stdClass $item)
    {
        $model = new Submission;
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
     * Get submissions list
     *
     * @return array
     */
    public function getList($formPath)
    {
        //$url = str_replace('{formPath}', $formPath, static::RESOURCE_LIST);
        //$items = $this->execute('GET', $url);
        $items = $this->execute('GET', 'http://www.mocky.io/v2/592c3c86110000f8016df7de');
        $list = [];

        foreach ($items as $item) {
            $model = static::toModel($item);
            $list[] = $model;
        }

        return $list;
    }

    /**
     * Get submission
     *
     * @param string $formPath
     * @param string $submissionId
     * @return \Ds\Component\Formio\Model\Submission
     */
    public function get($formPath, $submissionId)
    {
        //$url = str_replace(['{formPath}', '{submissionId}'], [$formPath, $submissionId], static::RESOURCE_ITEM);
        //$item = $this->execute('GET', $url);
        $item = $this->execute('GET', 'http://www.mocky.io/v2/592c4353110000e3026df7f8');
        $model = static::toModel($item);

        return $model;
    }

    public function create(Submission $submission)
    {

    }

    public function update(Submission $submission)
    {

    }

    public function delete($id)
    {

    }
}
