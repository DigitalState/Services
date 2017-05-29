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
     * @const string
     */
    const RESOURCE_LIST = '/user/submission';
    const RESOURCE_ITEM = '/user/submission/{userId}';
    const RESOURCE_ITEM_BY_FIELD = '/user/submission?{fieldName}={fieldValue}';
    const RESOURCE_ITEM_EXISTS = '/user/exists?data.email={{appUserEmail}}';

    protected $submissionService;
    
    /**
     * UserService constructor.
     */
    public function __construct() {
        $this->submissionService = new SubmissionService();
    }

    /**
     * API Resource <--> Model property mapping
     * @return array
     */
    public static function getMap() {
        return SubmissionService::getMap();
    }

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
                $model->{'set'.$local}($item->$remote);
            }
        }

        return $model;
    }

    /**
     * Get user list
     *
     * @return array
     */
    public function getList()
    {
        //$items = $this->execute('GET', static::RESOURCE_LIST);
        $items = $this->execute('GET', 'http://www.mocky.io/v2/592c6fc911000021066df852');
        $list = [];

        foreach ($items as $item) {
            $model = static::toModel($item);
            $list[] = $model;
        }

        return $list;
    }

    /**
     * Get user by ID
     *
     * @param string $id
     * @return \Ds\Component\Formio\Model\User
     */
    public function get($id)
    {
        //$item = $this->execute('GET', str_replace('{userId}', $id, static::RESOURCE_ITEM));
        $item = $this->execute('GET', 'http://www.mocky.io/v2/592c6f7311000029066df850');
        $model = static::toModel($item);

        return $model;
    }

    /**
     * Get user by an arbitrary field
     *
     * @param string $fieldName
     * @param string $fieldValue
     * @return \Ds\Component\Formio\Model\User
     */
    public function getByField($fieldName, $fieldValue)
    {
        //$url = str_replace(['{$fieldName}', '{$fieldValue}'], [$fieldName, $fieldValue], static::RESOURCE_ITEM_BY_FIELD);
        //$item = $this->execute('GET', $url);
        $item = $this->execute('GET', 'http://www.mocky.io/v2/592c6f7311000029066df850');
        $model = static::toModel($item);

        return $model;
    }

    public function getByDataField($dataFieldName, $dataFieldValue)
    {
        return $this->getByField('data.' . $dataFieldName, $dataFieldValue);
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
