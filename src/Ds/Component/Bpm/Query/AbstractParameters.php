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
    public function toArray($minimal = false)
    {
        $array = [];

        foreach ($this as $key => $value) {
            if ('_' === substr($key, 0, 1)) {
                continue;
            }

            if ($minimal && !$this->{'_'.$key}) {
                continue;
            }

            $array[$key] = $value;
        }

        return $array;
    }
}
