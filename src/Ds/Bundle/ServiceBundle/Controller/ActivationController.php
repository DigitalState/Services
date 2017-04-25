<?php

namespace Ds\Bundle\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;

class ActivationController extends BaseServiceController
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function getServiceFormSchemaAction(String $serviceUuid)
    {
        $service = $this->getServiceByUuid($serviceUuid);

        if ($service instanceof Response) {
            return $service;
        }

        $formioFormKey = $this->getCamundaFormKeyFromService($service);

        if ($formioFormKey instanceof Response) {
            return $formioFormKey;
        }
        elseif (is_string($formioFormKey)) {
            $formioResponse = $this->getFormSchemaAction($formioFormKey);
            return $formioResponse;
        }
        else {
            return $this->buildJsonResponseError('Unexpected internal process response.', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Fetch a form schema from a Formio server.
     *
     * @param $formioFormKey The path identifier of the requested form
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function getFormSchemaAction($formioFormKey)
    {
        $client = new HttpClient();
        $response = new JsonResponse();

        try {
            $formioResponse = $client->request('GET', $this->getParameter('formio_uri') . '/' . $formioFormKey);
            $formioResponseContents = $formioResponse->getBody()->getContents();
            $response->setContent($formioResponseContents);

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response->setStatusCode($e->getCode());
                $response->setData([
                    'statusCode' => $e->getCode(),
                    'error' => Response::$statusTexts[$e->getCode()],
                    'message' => 'invalid query'
                ]);
            }
            else {
                $errorMessage = 'Unable to retrieve form (' . $formioFormKey . ')';
                $response->setStatusCode(Response::HTTP_BAD_REQUEST);
                $response->setData([
                    'statusCode' => Response::HTTP_BAD_REQUEST,
                    'error' => Response::$statusTexts[Response::HTTP_BAD_REQUEST],
                    'message' => $errorMessage . ' :: ' . $e->getMessage()
                ]);
            }
        }

        return $response;
    }


}
