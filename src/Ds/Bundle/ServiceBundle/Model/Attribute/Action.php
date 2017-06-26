<?php

namespace Ds\Bundle\ServiceBundle\Model\Attribute;

/**
 * Trait Action
 */
trait Action
{
    use Accessor\Action;

    /**
     * @var string
     */
    protected $action;
}
