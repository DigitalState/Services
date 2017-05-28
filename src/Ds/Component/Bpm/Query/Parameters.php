<?php

namespace Ds\Component\Bpm\Query;

/**
 * Interface Parameters
 */
interface Parameters
{
    /**
     * Cast parameters to array
     *
     * @param boolean $minimal
     * @return array
     */
    public function toArray($minimal = false);
}
