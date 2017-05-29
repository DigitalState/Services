<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait Tags
 */
trait Tags
{
    /**
     * @var array
     */
    protected $tags; # region accessors

    /**
     * Set tags
     *
     * @param array $tags
     * @return object
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    # endregion
}
