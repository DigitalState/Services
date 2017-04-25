<?php
/**
 * Created by PhpStorm.
 * User: baddlan
 * Date: 2017-04-25
 * Time: 4:11 PM
 */

namespace Ds\Bundle\ServiceBundle\Controller;

use Ds\Bundle\ServiceBundle\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;

class BaseServiceController extends Controller {

    protected function getFormKeyFromCamundaProcessDefinition(String $processDefinitionKey) {
        $client = new HttpClient();
        $response = null;

        try {
            $camundaResponse = $client->request('GET', $this->getParameter('camunda_uri') . '/process-definition/key/' . $processDefinitionKey . '/startForm');
            $camundaResponseContents = $camundaResponse->getBody()->getContents();
            $camundaJson = \GuzzleHttp\json_decode($camundaResponseContents);
            return $camundaJson->key;

        } catch (\Exception $e) {
            $response = new JsonResponse();
            $errorMessage = 'Error while fetching process with key (' . $processDefinitionKey . ')';

            if (($e instanceof RequestException) && $e->hasResponse()) {
                $response->setStatusCode($e->getCode());
                $response->setData([
                    'statusCode' => $e->getCode(),
                    'error' => Response::$statusTexts[$e->getCode()],
                    'message' => $errorMessage
                ]);
            }
            else {
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

    protected function buildJsonResponseError(String $message, int $errorCode) {
        return new JsonResponse([
            'statusCode' => $errorCode,
            'error' => Response::$statusTexts[$errorCode],
            'message' => $message
        ], $errorCode);
    }

    protected function getServiceByUuid(String $serviceUuid) {
        $service = $this->getDoctrine()
            ->getRepository('DsServiceBundle:Service')
            ->findOneBy(['uuid' => $serviceUuid]);

        if (!$service) {
            return $this->buildJsonResponseError('Service not found', Response::HTTP_NOT_FOUND);
        }

        return $service;
    }

    protected function getCamundaFormKeyFromService(Service $service) {
        // The value of the `form` field is actually the value of the Camunda
        // Process Definition key from which the form
        $camundaProcessDefinitionKey = $service->getForm();
        $camundaResponse = $this->getFormKeyFromCamundaProcessDefinition($camundaProcessDefinitionKey);
        return $camundaResponse;
    }
}