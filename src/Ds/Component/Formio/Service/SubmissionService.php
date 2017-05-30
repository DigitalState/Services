<?php

namespace Ds\Component\Formio\Service;

use Ds\Component\Formio\Model\Submission;
use Ds\Component\Formio\Query\SubmissionParameters;
use stdClass;
use DateTime;

/**
 * Class SubmissionService
 */
class SubmissionService extends AbstractService
{
    /**
     * @const string
     */
    const RESOURCE_LIST = '/{form}/submission';
    const RESOURCE_OBJECT = '/{form}/submission/{id}';
    const RESOURCE_OBJECT_EXISTS = '/{form}/exists';

    /**
     * @var array
     */
    protected static $map = [
        'id' => '_id',
        'updated' => 'modified',
        'created',
        'form',
        'data',
        'externalIds',
        'access',
        'roles',
        'owner'
    ];

    /**
     * Cast object to model
     *
     * @param \stdClass $object
     * @return \Ds\Component\Formio\Model\Submission
     */
    public static function toModel(stdClass $object)
    {
        $model = new Submission;

        foreach (static::$map as $local => $remote) {
            if (is_int($local)) {
                $local = $remote;
            }

            if (property_exists($object, $remote)) {
                switch ($local) {
                    case 'created':
                    case 'updated':
                        $model->{'set'.ucfirst($local)}(new DateTime($object->$remote));
                        break;

                    default:
                        $model->{'set'.ucfirst($local)}($object->$remote);
                }
            }
        }

        return $model;
    }

    /**
     * Cast model to object
     *
     * @param \Ds\Component\Formio\Model\Submission $model
     * @return stdClass
     */
    public static function toStdClass(Submission $model)
    {
        $object = new stdClass;

        foreach (static::$map as $local => $remote) {
            if (is_int($local)) {
                $local = $remote;
            }

            switch ($local) {
                case 'created':
                case 'updated':
                    $object->$remote = $model->{'get'.ucfirst($local)}()->format('Y-m-d H:i:s');
                    break;

                default:
                    $object->$remote = $model->{'get'.ucfirst($local)}();
            }
        }

        return $object;
    }

    /**
     * Get submissions list
     *
     * @param string $form
     * @param \Ds\Component\Formio\Query\SubmissionParameters $parameters
     * @return array
     */
    public function getList($form, SubmissionParameters $parameters = null)
    {
        //$url = str_replace('{form}', $form, static::RESOURCE_LIST);
        //$objects = $this->execute('GET', $url);
        $objects = $this->execute('GET', 'http://www.mocky.io/v2/592c3c86110000f8016df7de', $parameters);
        $list = [];

        foreach ($objects as $object) {
            $model = $this->toModel($object);
            $list[] = $model;
        }

        return $list;
    }

    /**
     * Get submission
     *
     * @param string $form
     * @param string $id
     * @return \Ds\Component\Formio\Model\Submission
     */
    public function get($form, $id)
    {
        //$url = str_replace(['{form}', '{id}'], [$form, $id], static::RESOURCE_OBJECT);
        //$object = $this->execute('GET', $url);
        $object = $this->execute('GET', 'http://www.mocky.io/v2/592c4353110000e3026df7f8');
        $model = $this->toModel($object);

        return $model;
    }

    /**
     * Check whether a submission exists
     *
     * @param string $form
     * @param \Ds\Component\Formio\Query\SubmissionParameters $parameters
     * @return boolean
     */
    public function exists($form, SubmissionParameters $parameters = null)
    {
        //$url = str_replace('{form}, $form, static::RESOURCE_OBJECT_EXISTS);
        //$object = $this->execute('GET', $url);
        $object = $this->execute('GET', 'http://www.mocky.io/v2/592c6f7311000029066df850');

        if ($object && property_exists($object, '_id') && $object->_id) {
            return true;
        }

        return false;
    }

    /**
     * Create submission
     *
     * @param \Ds\Component\Formio\Model\Submission $submission
     */
    public function create(Submission $submission)
    {

    }

    /**
     * Update submission
     *
     * @param \Ds\Component\Formio\Model\Submission $submission
     */
    public function update(Submission $submission)
    {

    }

    /**
     * Delete submission
     *
     * @param string $id
     */
    public function delete($id)
    {

    }
}
