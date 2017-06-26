<?php

namespace Ds\Bundle\ServiceBundle\Model\Attribute;

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
