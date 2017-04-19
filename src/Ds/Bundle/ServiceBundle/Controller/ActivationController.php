<?php

namespace Ds\Bundle\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $response = new JsonResponse();

        try {
            $formioResponse = $client->request('GET', $this->getParameter('formio_uri') . '/' . $formPath);
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
                $errorMessage = 'Unable to retrieve form (' . $formPath . ')';
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
