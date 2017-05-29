<?php

namespace Ds\Component\Formio\Api;

use GuzzleHttp\ClientInterface;

/**
 * Class Api
 */
class Api
{
    /**
     * @var \Ds\Component\Formio\Service\AuthenticationService
     */
    public $authentication;

    /**
     * @var \Ds\Component\Formio\Service\ProjectService
     */
    public $project;

    /**
     * @var \Ds\Component\Formio\Service\FormService
     */
    public $form;

    /**
     * @var \Ds\Component\Formio\Service\SubmissionService
     */
    public $submission;

    /**
     * Constructor
     *
     * @param \GuzzleHttp\ClientInterface $client
     * @param string $host
     */
    public function __construct(ClientInterface $client, $host = null)
    {
        $services = array_keys(get_object_vars($this));

        foreach ($services as $service) {
            $class = '\\Ds\\Component\\Formio\\Service\\'.ucfirst($service).'Service';
            $this->$service = new $class($client, $host);
        }
    }

    /**
     * Set host
     *
     * @param string $host
     * @return \Ds\Component\Formio\Api\Api
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
