<?php

namespace AppBundle\Model\Attribute;

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
