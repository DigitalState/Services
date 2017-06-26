<?php

namespace Ds\Bundle\ServiceBundle\Model\Attribute;

/**
 * Trait Method
 */
trait Method
{
    use Accessor\Method;

    /**
     * @var string
     */
    protected $method;
}
