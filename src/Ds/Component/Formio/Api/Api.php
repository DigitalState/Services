<?php

namespace Ds\Component\Formio\Api;

use GuzzleHttp\ClientInterface;
use Ds\Component\Formio\Service;

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
     * @var \Ds\Component\Formio\Service\UserService
     */
    public $user;

    /**
     * Constructor
     *
     * @param \GuzzleHttp\ClientInterface $client
     * @param string $host
     */
    public function __construct(ClientInterface $client, $host = null)
    {
        $this->authentication = new Service\AuthenticationService($client, $host);
        $this->project = new Service\ProjectService($client, $host);
        $this->form = new Service\FormService($client, $host);
        $this->submission = new Service\SubmissionService($client, $host);
        $this->user = new Service\UserService($client, $host);
    }

    /**
     * Set host
     *
     * @param string $host
     * @return \Ds\Component\Formio\Api\Api
     */
    public function setHost($host)
    {
        $this->authentication->setHost($host);
        $this->project->setHost($host);
        $this->form->setHost($host);
        $this->user->setHost($host);
        $this->submission->setHost($host);

        return $this;
    }
}
