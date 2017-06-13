<?php

namespace Ds\Bundle\ServiceBundle\Model\Scenario;

use Ds\Component\Model\Accessor;

/**
 * Class Form
 */
class Form
{
    use Accessor\Type;
    use Accessor\Value;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var mixed
     */
    protected $value;
}
