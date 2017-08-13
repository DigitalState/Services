<?php

namespace Ds\Component\Bpm\Resolver;

use DomainException;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Class TaskResolver
 */
class TaskResolver extends AbstractResolver
{
    /**
     * @const string
     */
    const PATTERN = '/^ds\.bpm\.task\[([-a-zA-Z0-9])\](.*)/';

    /**
     * {@inheritdoc}
     */
    public function resolve($variable)
    {
        if (!preg_match(static::PATTERN, $variable, $matches)) {
            throw new DomainException('Variable pattern is not valid.');
        }

        $id = $matches[1];
        $property = $matches[2];
//        $task = $this->api->task->get($id);
        $task = new \Ds\Component\Bpm\Model\Task;
        $task
            ->setId('123')
            ->getVariables()->var_1 = '456';
        $accessor = PropertyAccess::createPropertyAccessor();
        $value = $accessor->getValue($task, $property);

        return $value;
    }
}
