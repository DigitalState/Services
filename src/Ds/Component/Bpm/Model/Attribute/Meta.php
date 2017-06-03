<?php

namespace Ds\Component\Bpm\Model\Attribute;

use stdClass;

/**
 * Trait Meta
 */
trait Meta
{
    /**
     * @var \stdClass
     */
    protected $meta; # region accessors

    /**
     * Set meta
     *
     * @param \stdClass $meta
     * @return object
     */
    public function setMeta(stdClass $meta = null)
    {
        if (null === $meta) {
            $meta = new stdClass;
        }

        $this->meta = $meta;

        return $this;
    }

    /**
     * Get meta
     *
     * @return \stdClass
     */
    public function getMeta()
    {
        return $this->meta;
    }

    # endregion
}
