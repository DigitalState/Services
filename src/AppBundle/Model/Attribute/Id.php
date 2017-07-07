<?php

namespace AppBundle\Model\Attribute;

/**
 * Trait Id
 */
trait Id
{
    use Accessor\Id;

    /**
     * @var string
     */
    protected $id;
}
