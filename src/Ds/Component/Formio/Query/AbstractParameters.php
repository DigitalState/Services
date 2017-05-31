<?php

namespace Ds\Component\Formio\Query;

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

            $object->$key = $value;
        }

        return $object;
    }
}
