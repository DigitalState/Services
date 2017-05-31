<?php

namespace Ds\Component\BpmCamunda\Api;

use Ds\Component\Bpm\Api\Api as BaseApi;
use GuzzleHttp\ClientInterface;
use Ds\Component\BpmCamunda\Service;

/**
 * Class Api
 */
class Api extends BaseApi
{
    /**
     * Constructor
     *
     * @param \GuzzleHttp\ClientInterface $client
     * @param string $host
     */
    public function __construct(ClientInterface $client, $host = null)
    {
        $this->processDefinition = new Service\ProcessDefinitionService($client, $host);
        $this->processInstance = new Service\ProcessInstanceService($client, $host);
        $this->task = new Service\TaskService($client, $host);
    }

    /**
     * Set host
     *
     * @param string $host
     * @return \Ds\Component\Bpm\Api\Api
     */
    public function setHost($host)
    {
        $this->processDefinition->setHost($host);
        $this->processInstance->setHost($host);
        $this->task->setHost($host);
    }
}
