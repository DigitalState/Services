<?php

namespace Ds\Bundle\BpmBundle\Bpm\Api;

use Ds\Bundle\BpmBundle\Collection\Bpm\ApiCollection;
use LogicException;

/**
 * Class Factory
 */
class Factory
{
    /**
     * @var \Ds\Bundle\BpmBundle\Collection\Bpm\ApiCollection
     */
    protected $apiCollection;

    /**
     * Constructor.
     *
     * @param \Ds\Bundle\BpmBundle\Collection\Bpm\ApiCollection $apiCollection
     */
    public function __construct(ApiCollection $apiCollection)
    {
        $this->apiCollection = $apiCollection;
    }

    /**
     * Create api instance
     *
     * @param string $alias
     * @return \Ds\Component\Bpm\Api\Api
     * @throws \LogicException
     */
    public function create($alias)
    {
        $apis = clone $this->apiCollection->filter(function($item) use ($alias) {
            return $item['alias'] == $alias;
        });

        if (!count($apis)) {
            throw new LogicException('Api does not exist.');
        }

        $api = $apis->first()['api'];

        return $api;
    }
}
