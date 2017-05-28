<?php

namespace Ds\Component\BpmCamunda\Api;

use Ds\Component\Bpm\Api\Api as BaseApi;
use GuzzleHttp\ClientInterface;

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
    public function __construct(ClientInterface $client, $host = 'http://localhost:8080/engine-rest')
    {
        $services = array_keys(get_object_vars($this));

        foreach ($services as $service) {
            $class = '\\Ds\\Component\\BpmCamunda\\Service\\'.ucfirst($service).'Service';
            $this->$service = new $class($client, $host);
        }
    }

    /**
     * Set host
     *
     * @param string $host
     * @return \Ds\Component\Bpm\Api\Api
     */
    public function setHost($host)
    {
        $services = array_keys(get_object_vars($this));

        foreach ($services as $service) {
            $this->$service->setHost($host);
        }

        return $this;
    }
}
