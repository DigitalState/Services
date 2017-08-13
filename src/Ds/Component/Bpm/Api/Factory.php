<?php

namespace Ds\Component\Bpm\Api;

use Ds\Component\Bpm\Collection\ApiCollection;
use Ds\Component\Config\Service\ConfigService;
use LogicException;

/**
 * Class Factory
 */
class Factory
{
    /**
     * @var \Ds\Component\Bpm\Collection\ApiCollection
     */
    protected $apiCollection;

    /**
     * @var \Ds\Component\Config\Service\ConfigService
     */
    protected $configService;

    /**
     * Constructor.
     *
     * @param \Ds\Component\Bpm\Collection\ApiCollection $apiCollection
     * @param \Ds\Component\Config\Service\ConfigService $configService
     */
    public function __construct(ApiCollection $apiCollection, ConfigService $configService)
    {
        $this->apiCollection = $apiCollection;
        $this->configService = $configService;
    }

    /**
     * Create api instance
     *
     * @param string $alias
     * @return \Ds\Component\Bpm\Api\Api
     * @throws \LogicException
     */
    public function api($alias)
    {
        if (!$this->apiCollection->containsKey($alias)) {
            throw new LogicException('Api does not exist.');
        }

        $api = $this->apiCollection->get($alias);

        return $api;
    }
}
