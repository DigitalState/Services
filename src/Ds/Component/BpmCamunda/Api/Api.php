<?php

namespace Ds\Component\BpmCamunda\Api;

use Ds\Component\Bpm\Api\Api as ApiInterface;
use GuzzleHttp\ClientInterface;
use LogicException;

/**
 * Class Api
 */
class Api implements ApiInterface
{
    /**
     * @var \Ds\Component\BpmCamunda\Service\ProcessDefinitionService
     */
    protected $processDefinition;

    /**
     * @var \Ds\Component\BpmCamunda\Service\ProcessInstanceService
     */
    protected $processInstance;

    /**
     * @var \Ds\Component\BpmCamunda\Service\TaskService
     */
    protected $task;

    /**
     * Get services
     *
     * @return array
     */
    protected static function getServices()
    {
        return [
            'processDefinition', 'processInstance', 'task'
        ];
    }

    /**
     * Constructor
     *
     * @param \GuzzleHttp\ClientInterface $client
     * @param string $host
     */
    public function __construct(ClientInterface $client, $host = null)
    {
        foreach (static::getServices() as $service) {
            $class = '\\Ds\\Component\\BpmCamunda\\Service\\'.ucfirst($service).'Service';
            $this->$service = new $class($client, $host);
        }
    }

    /**
     * Get service
     *
     * @param string $service
     * @return \Ds\Component\Bpm\Service\Service
     * @throws \LogicException
     */
    public function __get($service)
    {
        if (!in_array($service, static::getServices(), true)) {
            throw new LogicException('Service does not exist.');
        }

        return $this->$service;
    }

    /**
     * Set host
     *
     * @param string $host
     * @return \Ds\Component\Bpm\Api\Api
     */
    public function setHost($host)
    {
        foreach (static::getServices() as $service) {
            $this->$service->setHost($host);
        }

        return $this;
    }
}
