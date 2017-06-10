<?php

namespace Ds\Component\Formio\Service;

use Ds\Component\Formio\Model\Project;

/**
 * Class ProjectService
 */
class ProjectService extends AbstractService
{
    /**
     * @const string
     */
    const MODEL = Project::class;

    /**
     * @var array
     */
    protected static $map = [
        'id' => '_id',
        'updated' => 'modified',
        'title'
    ];
}
