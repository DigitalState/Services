<?php

namespace Ds\Component\Bpm\Resolver;

use DomainException;

/**
 * Class BpmResolver
 */
class BpmResolver extends AbstractResolver
{
    /**
     * @const string
     */
    const PATTERN = '/^ds\.context\.bpm\./';

    /**
     * {@inheritdoc}
     */
    public function resolve($variable)
    {
        if (!$this->isMatch($variable)) {
            throw new DomainException('Variable pattern is not valid.');
        }

        $value = 12222;

        return $value;
    }
}
