<?php

namespace Ds\Component\Formio\Model\Attribute;

/**
 * Trait Title
 */
trait Title
{
    /**
     * @var string
     */
    protected $title; # region accessors

    /**
     * Set title
     *
     * @param string $title
     * @return object
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    # endregion
}
