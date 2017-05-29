<?php

namespace Ds\Component\Formio\Service;

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
    protected $host; # region accessors

    /**
     * Set host
     *
     * @param string $host
     * @return \Ds\Component\Formio\Service\Service
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    # endregion

    /**
     * Constructor
     *
     * @param \GuzzleHttp\ClientInterface $client
     * @param string $host
     */
    public function __construct(ClientInterface $client, $host = null)
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
        $options = ['content-type' => 'application/json'];
        $response = $this->client->request($method, $uri, $options);

        try {
            $data = \GuzzleHttp\json_decode($response->getBody());
        } catch (InvalidArgumentException $exception) {
            throw new UnexpectedValueException('Service response is not valid.', 0, $exception);
        }

        return $data;
    }

    public abstract static function getMap();

    /**
     * Cast model to std object
     *
     * @param object Model
     * @return stdClass
     */
    public static function toStdClass($model)
    {
        $properties = static::getMap();
        $item = new stdClass;

        foreach ($properties as $local => $remote) {
            if (is_int($local)) {
                $local = $remote;
            }

            if (property_exists($model, $remote)) {
                $item->$remote = $model->{'get' . ucfirst($local)}();
            }
        }

        return $item;
    }
}
