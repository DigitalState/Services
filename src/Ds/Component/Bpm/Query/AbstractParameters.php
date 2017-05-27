<?php

namespace Ds\Component\Bpm\Query;

/**
 * Class AbstractParameters
 */
abstract class AbstractParameters implements Parameters
{
    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $array = [];

        foreach ($this as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }
}
