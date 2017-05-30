<?php

namespace Ds\Component\Formio\Service;

use Ds\Component\Formio\Model\User;
use Ds\Component\Formio\Query\UserParameters;
use stdClass;
use DateTime;

/**
 * Class UserService
 */
class UserService extends AbstractService
{
    /**
     * @const string
     */
    const RESOURCE_LIST = '/user/submission';
    const RESOURCE_OBJECT = '/user/submission/{id}';
    const RESOURCE_OBJECT_EXISTS = '/user/exists';

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
     * @return \Ds\Component\Formio\Model\User
     */
    public static function toModel(stdClass $object)
    {
        $model = new User;

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
     * @param \Ds\Component\Formio\Model\User $model
     * @return stdClass
     */
    public static function toStdClass(User $model)
    {
        $object = new stdClass;

        foreach (static::$map as $local => $remote) {
            if (is_int($local)) {
                $local = $remote;
            }

            if (property_exists($model, $remote)) {
                switch ($local) {
                    case 'created':
                    case 'updated':
                        $object->$remote = $model->{'get'.ucfirst($local)}()->format('Y-m-d H:i:s');
                        break;

                    default:
                        $object->$remote = $model->{'get'.ucfirst($local)}();
                }
            }
        }

        return $object;
    }

    /**
     * Get submissions list
     *
     * @param string $form
     * @return array
     */
    public function getList($form)
    {
        //$url = str_replace('{form}', $form, static::RESOURCE_LIST);
        //$objects = $this->execute('GET', $url);
        $objects = $this->execute('GET', 'http://www.mocky.io/v2/592c3c86110000f8016df7de');
        $list = [];

        foreach ($objects as $object) {
            $model = $this->toModel($object);
            $list[] = $model;
        }

        return $list;
    }

    /**
     * Get user
     *
     * @param string $form
     * @param string $id
     * @return \Ds\Component\Formio\Model\User
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
     * Check whether a submission exists using an arbitrary field
     *
     * @param \Ds\Component\Formio\Query\UserParameters $parameters
     * @return boolean
     */
    public function existsByField(UserParameters $parameters = null)
    {
        //$url = str_replace(['{$fieldName}', '{$fieldValue}'], [$fieldName, $fieldValue], static::RESOURCE_OBJECT_EXISTS);
        //$object = $this->execute('GET', $url);
        $object = $this->execute('GET', 'http://www.mocky.io/v2/592c6f7311000029066df850');

        if ($object && property_exists($object, '_id') && $object->_id) {
            return true;
        }

        return false;
    }

    /**
     * Create user
     *
     * @param \Ds\Component\Formio\Model\User $user
     */
    public function create(User $user)
    {

    }

    /**
     * Update user
     *
     * @param \Ds\Component\Formio\Model\User $user
     */
    public function update(User $user)
    {

    }

    /**
     * Delete user
     *
     * @param string $id
     */
    public function delete($id)
    {

    }
}
