<?php

namespace Ds\Component\Bpm\Service;

use GuzzleHttp\ClientInterface;
use InvalidArgumentException;
use UnexpectedValueException;

/**
 * Class AbstractService
 */
abstract class AbstractService implements Service
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $host;

    /**
     * Constructor
     *
     * @param \GuzzleHttp\ClientInterface $client
     * @param string $host
     */
    public function __construct(ClientInterface $client, $host)
    {
        $this->client = $client;
        $this->host = $host;
    }

    /**
     * Execute api request
     *
     * @param string $method
     * @param string $resource
     * @return mixed
     */
    protected function execute($method, $resource)
    {
        $uri = $this->host.$resource;
        $response = $this->client->request($method, $uri);

        try {
            $data = \GuzzleHttp\json_decode($response->getBody());
        } catch (InvalidArgumentException $exception) {
            throw new UnexpectedValueException('Service response is not valid.', 0, $exception);
        }

        return $data;
    }
}
