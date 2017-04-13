<?php

namespace Ds\Bundle\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;

class ActivationController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * Fetch a form schema from a Formio server.
     *
     * @param $formPath The path identifier of the requested form
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function getFormSchemaAction($formPath)
    {
        $client = new HttpClient();
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        try {
            $formioResponse = $client->request('GET', 'http://localhost:3001/' . $formPath);
            $formioResponseContents = $formioResponse->getBody()->getContents();
            $response->setContent($formioResponseContents);

        } catch (RequestException $e) {
            $errorMessage = 'Unable to retrieve form (' . $formPath . ')';
            if ($e->hasResponse()) {
                throw new \Exception($errorMessage . ' :: ' . Psr7\str($e->getResponse()));
            }
            else {
                throw new \Exception($errorMessage);
            }
        }

        return $response;
    }
}
