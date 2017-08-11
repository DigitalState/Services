<?php

namespace Ds\Component\Bpm\Resolver\Context;

use DomainException;
use Ds\Component\Resolver\Resolver\Resolver;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Class BpmResolver
 */
class BpmResolver implements Resolver
{
    /**
     * @const string
     */
    const PATTERN = '/^ds\.context\.bpm\./';

    /**
     * Constructor
     */
    public function __construct()
    {

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
    public function resolve($variable)
    {
        if (!preg_match(static::PATTERN, $variable, $matches)) {
            throw new DomainException('Variable pattern is not valid.');
        }

        return 123;
    }
}
