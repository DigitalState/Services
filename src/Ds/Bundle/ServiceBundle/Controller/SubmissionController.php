<?php

namespace Ds\Bundle\ServiceBundle\Controller;

use GuzzleHttp\Exception\RequestException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client as HttpClient;

class SubmissionController extends BaseServiceController
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function validateAndSubmitAction(Request $request, $serviceUuid)
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
            $formValidationResponse = $this->validateFormAction($request, $formioFormKey);

            if ($formValidationResponse instanceof Response) { // form validation failed
                return $formValidationResponse;
            }
            elseif ($formValidationResponse === true) { // form validation succeeded
                $camundaProcessDefinitionKey = $service->getForm();
                $camundaProcessVariables = \GuzzleHttp\json_decode($request->getContent());
                $processLaunchResponse = $this->startCamundaProcess($camundaProcessDefinitionKey, $camundaProcessVariables->data);
                return $processLaunchResponse;
            }
        }
        else {
            return $this->buildJsonResponseError('Unexpected internal process response.', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Validate submission data against a Formio form.
     *
     * The resulting JSON returned from Formio is output as is if the validation
     * is successful, otherwise the an `bad request` error code will be issued
     * along with the JSON formatted validation error from Formio.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param $formioFormKey
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function validateFormAction(Request $request, String $formioFormKey)
    {
        $formData = $request->getContent();
        $client = new HttpClient();

        try {
            $requestUri = $this->getParameter('formio_uri') . '/' . $formioFormKey . '/submission';
            $formioResponse = $client->request('POST', $requestUri, [
                'body' => $formData,
                'query' => [
                    'dryrun' => 1
                ],
                'headers'  => [
                    'Content-Type' => 'application/json'
                ]
            ]);

//            $formioResponseContents = $formioResponse->getBody()->getContents();
//            $response->setData($formioResponseContents);
            return true;

        } catch (\Exception $e) {
            $response = new JsonResponse();

            if (($e instanceof RequestException) && $e->hasResponse()) {
                $responseSummary = RequestException::getResponseBodySummary($e->getResponse());
                $decodedJsonMessage = json_decode($e->getResponse()->getBody()->getContents());
                $responseMessage = empty($decodedJsonMessage) ? $responseSummary : $decodedJsonMessage;

                if (empty($responseMessage)) {
                    $responseMessage = $e->getMessage();
                }

                $response->setStatusCode($e->getCode());
                $response->setData([
                    'statusCode' => $e->getCode(),
                    'error' => Response::$statusTexts[$e->getCode()],
                    'message' => $responseMessage,
                ]);
            }
            else {
                $errorMessage = 'Unable to validate form (' . $formioFormKey . ')';
                $response->setStatusCode(Response::HTTP_BAD_REQUEST);
                $response->setData([
                    'statusCode' => Response::HTTP_BAD_REQUEST,
                    'error' => Response::$statusTexts[Response::HTTP_BAD_REQUEST],
                    'message' => $errorMessage . ' :: ' . $e->getMessage(),
                ]);
            }

            return $response;
        }
    }


    protected function startCamundaProcess(String $processDefinitionKey, $processVariables) {
        $client = new HttpClient();
        $response = new JsonResponse();

        try {
            $requestUri = $this->getParameter('camunda_uri') . '/process-definition/key/' . $processDefinitionKey . '/start';
            $camundaResponse = $client->request('POST', $requestUri, [
                'body' => \GuzzleHttp\json_encode([
                    'variables' => [
                        'formSubmission' => [
                            'type' => 'json',
                            'value' => \GuzzleHttp\json_encode($processVariables)
                        ]
                    ],
                    'withVariablesInReturn' => true
                ]),
                'headers'  => [
                    'Content-Type' => 'application/json'
                ]
            ]);

            $camundaResponseContents = $camundaResponse->getBody()->getContents();
            $camundaJson = \GuzzleHttp\json_decode($camundaResponseContents);
            $camundaSubmissionResponseValue = \GuzzleHttp\json_decode($camundaJson->variables->submissionResponse->value);
            return $response->setData($camundaSubmissionResponseValue);
        } catch (\Exception $e) {

            $errorMessage = 'Error while starting process with key (' . $processDefinitionKey . ')';

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

            return $response;
        }
    }
}
