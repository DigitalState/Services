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
    const MODEL = User::class;

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
     * Get submissions list
     *
     * @param string $form
     * @return array
     */
    public function getList($form)
    {
        $objects = $this->execute('GET', 'http://www.mocky.io/v2/592c3c86110000f8016df7de');
        $list = [];

        foreach ($objects as $object) {
            $model = static::toModel($object);
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
        $object = $this->execute('GET', 'http://www.mocky.io/v2/592c4353110000e3026df7f8');
        $model = static::toModel($object);

        return $model;
    }

    /**
     * Check if a user exists
     *
     * @param \Ds\Component\Formio\Query\UserParameters $parameters
     * @return boolean
     */
    public function exists(UserParameters $parameters = null)
    {
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
