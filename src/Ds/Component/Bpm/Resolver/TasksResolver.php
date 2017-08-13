<?php

namespace Ds\Component\Bpm\Resolver;

use DomainException;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Class TasksResolver
 */
class TasksResolver extends AbstractResolver
{
    /**
     * @const string
     */
    const PATTERN = '/^ds\.bpm\.tasks(.*)/';

    /**
     * {@inheritdoc}
     */
    public function resolve($variable)
    {
        if (!preg_match(static::PATTERN, $variable, $matches)) {
            throw new DomainException('Variable pattern is not valid.');
        }

        $property = $matches[1];
//        $tasks = $this->api->task->getList();
        $tasks = [];
        $accessor = PropertyAccess::createPropertyAccessor();
        $value = $accessor->getValue($tasks, $property);

        return $value;
    }
}
