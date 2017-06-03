<?php

namespace Ds\Component\Bpm\Query;

use GuzzleHttp;
use Ds\Component\Bpm\Model\Variable;
use stdClass;

/**
 * Class AbstractParameters
 */
abstract class AbstractParameters implements Parameters
{
    /**
     * {@inheritdoc}
     */
    public function toObject($minimal = false)
    {
        $object = new stdClass;

        foreach ($this as $key => $value) {
            if ('_' === substr($key, 0, 1)) {
                continue;
            }

            if ($minimal && !$this->{'_'.$key}) {
                continue;
            }

            switch ($key) {
                case 'variables':
                    $object->$key = new stdClass;

                    foreach ($value as $variable) {
                        $object->$key->{$variable->getName()} = $variable->toObject(true);

                        if (Variable::TYPE_JSON === $variable->getType()) {
                            $object->$key->{$variable->getName()}->value = GuzzleHttp\json_encode($object->$key->{$variable->getName()}->value);
                        }
                    }

                    break;

                default:
                    $object->$key = $value;
            }
        }

        return $object;
    }
}
