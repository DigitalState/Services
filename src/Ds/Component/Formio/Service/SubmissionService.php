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
    const RESOURCE_ITEM_BY_FIELD = '/{formPath}/submission?{fieldName}={fieldValue}';
    const RESOURCE_ITEM_EXISTS_BY_FIELD = '/{formPath}/exists?{fieldName}={{fieldValue}}';

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
                $model->{'set' . ucfirst($local)}($item->$remote);
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

    /**
     * Get submission by an arbitrary field
     *
     * @param string $fieldName
     * @param string $fieldValue
     * @return \Ds\Component\Formio\Model\Submission
     */
    public function getByField($fieldName, $fieldValue)
    {
        //$url = str_replace(['{$fieldName}', '{$fieldValue}'], [$fieldName, $fieldValue], static::RESOURCE_ITEM_BY_FIELD);
        //$item = $this->execute('GET', $url);
        $item = $this->execute('GET', 'http://www.mocky.io/v2/592c6f7311000029066df850');
        $model = static::toModel($item);

        return $model;
    }

    /**
     * Get submission by an arbitrary data field
     *
     * @param $dataFieldName
     * @param $dataFieldValue
     * @return \Ds\Component\Formio\Model\Submission
     */
    public function getByDataField($dataFieldName, $dataFieldValue)
    {
        return $this->getByField('data.' . $dataFieldName, $dataFieldValue);
    }

    /**
     * Check whether a submission exists using an arbitrary field
     *
     * @param string $fieldName
     * @param string $fieldValue
     * @return boolean
     */
    public function existsByField($fieldName, $fieldValue)
    {
        //$url = str_replace(['{$fieldName}', '{$fieldValue}'], [$fieldName, $fieldValue], static::RESOURCE_ITEM_EXISTS_BY_FIELD);
        //$item = $this->execute('GET', $url);
        $item = $this->execute('GET', 'http://www.mocky.io/v2/592c6f7311000029066df850');

        if ($item && property_exists($item, '_id') && !empty($item->_id)) {
            return true;
        }

        return false;
    }

    /**
     * Check whether a submission exists using an arbitrary data field
     * @param $dataFieldName
     * @param $dataFieldValue
     * @return bool
     */
    public function existsByDataField($dataFieldName, $dataFieldValue) {
        return $this->existsByField('data.' . $dataFieldName, $dataFieldValue);
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
