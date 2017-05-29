<?php

namespace Ds\Component\Formio\Service;

use Ds\Component\Formio\Model\User;
use stdClass;

/**
 * Class UserService
 */
class UserService extends SubmissionService
{
    /**
     * @const string
     */
    const RESOURCE_LIST = '/user/submission';
    const RESOURCE_ITEM = '/user/submission/{userId}';
    const RESOURCE_ITEM_BY_FIELD = '/user/submission?{fieldName}={fieldValue}';
    const RESOURCE_ITEM_EXISTS = '/user/exists?data.email={{appUserEmail}}';


    /**
     * Cast object to model
     *
     * @param stdClass $item
     * @return \Ds\Component\Formio\Model\User
     */
    public static function toModel(stdClass $item)
    {
        $model = new User;
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
     * Get user by email address.
     *
     * @param string $email
     * @return \Ds\Component\Formio\Model\User
     */
    public function getByEmail($email)
    {
        return $this->getByDataField('email', $email);
    }

    /**
     * Check whether the user exists using his/her email address.
     *
     * @param string $email
     * @return boolean
     */
    public function existsByEmail($email)
    {
        return $this->existsByDataField('email', $email);
    }

    public function create(User $user)
    {

    }

    public function update(User $user)
    {

    }

    public function delete($id)
    {

    }
}
