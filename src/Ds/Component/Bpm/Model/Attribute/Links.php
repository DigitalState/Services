<?php

namespace Ds\Component\Bpm\Model\Attribute;

/**
 * Trait Links
 */
trait Links
{
    /**
     * @var array
     */
    protected $links; # region accessors

    /**
     * Set links
     *
     * @param array $links
     * @return object
     */
    public function setLinks($links)
    {
        $this->links = $links;

        return $this;
    }

    /**
     * Get links
     *
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    # endregion
}
