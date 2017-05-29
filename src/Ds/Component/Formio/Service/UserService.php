<?php

namespace Ds\Component\Formio\Service;

use Ds\Component\Formio\Model\User;
use stdClass;

/**
 * Class UserService
 */
class UserService extends AbstractService
{
    /**
     * Cast object to model
     *
     * @param stdClass $item
     * @return \Ds\Component\Formio\Model\User
     */
    public static function toModel(stdClass $item)
    {
        $model = new User;
        $properties = [
            'id' => '_id',
            'updated' => 'modified'
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

    public function getList()
    {

    }

    public function get($id)
    {

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
