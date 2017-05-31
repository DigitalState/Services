<?php

namespace Ds\Bundle\BpmBundle\Api;

use Ds\Bundle\BpmBundle\Collection\ApiCollection;
use Ds\Component\Config\Service\ConfigService;
use LogicException;

/**
 * Class Factory
 */
class Factory
{
    /**
     * @var \Ds\Bundle\BpmBundle\Collection\ApiCollection
     */
    protected $apiCollection;

    /**
     * @var \Ds\Component\Config\Service\ConfigService
     */
    protected $configService;

    /**
     * Constructor.
     *
     * @param \Ds\Bundle\BpmBundle\Collection\ApiCollection $apiCollection
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
        $api->setHost($this->configService->get('ds_bpm_'.$alias.'.api.url'));

        return $api;
    }
}
