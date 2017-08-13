<?php

namespace Ds\Component\Bpm\Resolver;

use Ds\Component\Bpm\Api\Factory;
use Ds\Component\Resolver\Resolver\Resolver;

/**
 * Class AbstractResolver
 */
abstract class AbstractResolver implements Resolver
{
    /**
     * @const string
     */
    const PATTERN = null;

    /**
     * @var \Ds\Component\Bpm\Api\Api
     */
    protected $api;

    /**
     * Constructor
     *
     * @param \Ds\Component\Bpm\Api\Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->api = $factory->api('camunda');
    }

    /**
     * {@inheritdoc}
     */
    public function isMatch($variable)
    {
        return preg_match(static::PATTERN, $variable);
    }

    /**
     * {@inheritdoc}
     */
    abstract public function resolve($variable);
}
