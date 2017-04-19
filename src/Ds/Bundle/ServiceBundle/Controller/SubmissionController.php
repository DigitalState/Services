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

class SubmissionController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    /**
     * Validate submission data against a Formio form.
     *
     * The resulting JSON returned from Formio is output as is if the validation
     * is successful, otherwise the an `bad request` error code will be issued
     * along with the JSON formatted validation error from Formio.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param $formPath
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function validateFormAction(Request $request, $formPath)
    {
        $formData = $request->getContent();
        $client = new HttpClient();
        $response = new JsonResponse();

        try {
            $requestUri = $this->getParameter('formio_uri') . '/' . $formPath . '/submission';
            $formioResponse = $client->request('POST', $requestUri, [
                'body' => $formData,
                'query' => [
                    'dryrun' => 1
                ],
                'headers'  => [
                    'Content-Type' => 'application/json'
                ]
            ]);

            $formioResponseContents = $formioResponse->getBody()->getContents();
            $response->setData($formioResponseContents);

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
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
                $errorMessage = 'Unable to validate form (' . $formPath . ')';
                $response->setStatusCode(Response::HTTP_BAD_REQUEST);
                $response->setData([
                    'statusCode' => Response::HTTP_BAD_REQUEST,
                    'error' => Response::$statusTexts[Response::HTTP_BAD_REQUEST],
                    'message' => $errorMessage . ' :: ' . $e->getMessage(),
                ]);
            }
        }

        return $response;
    }
}
