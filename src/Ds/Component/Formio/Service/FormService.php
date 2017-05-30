<?php

namespace Ds\Component\Formio\Service;

use Ds\Component\Formio\Model\Form;
use Ds\Component\Formio\Query\FormParameters;
use stdClass;
use DateTime;

/**
 * Class FormService
 */
class FormService extends AbstractService
{
    /**
     * @const string
     */
    const RESOURCE_LIST = '/form';
    const RESOURCE_OBJECT = '/form/{id}';

    /**
     * @var array
     */
    protected static $map = [
        'id' => '_id',
        'updated' => 'modified',
        'created',
        'title',
        'display',
        'type',
        'name',
        'path',
        'components',
        'tags',
        'access',
        'roles',
        'owner'
    ];

    /**
     * Cast object to model
     *
     * @param \stdClass $object
     * @return \Ds\Component\Formio\Model\Form
     */
    public static function toModel(stdClass $object)
    {
        $model = new Form;

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
     * @param \Ds\Component\Formio\Model\Form $model
     * @return stdClass
     */
    public static function toStdClass(Form $model)
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
     * Get form list
     *
     * @param \Ds\Component\Formio\Query\FormParameters $parameters
     * @return array
     */
    public function getList(FormParameters $parameters = null)
    {
        //$objects = $this->execute('GET', static::RESOURCE_LIST, $parameters);
        $objects = $this->execute('GET', 'http://www.mocky.io/v2/592b798d100000b10e389778', $parameters);
        $list = [];

        foreach ($objects as $object) {
            $model = $this->toModel($object);
            $list[] = $model;
        }

        return $list;
    }

    /**
     * Get form
     *
     * @param string $id
     * @return \Ds\Component\Formio\Model\Form
     */
    public function get($id)
    {
        //$object = $this->execute('GET', str_replace('{id}', $id, static::RESOURCE_OBJECT));
        $object = $this->execute('GET', 'http://www.mocky.io/v2/592b7a27100000b10e38977b');
        $model = $this->toModel($object);

        return $model;
    }
}
