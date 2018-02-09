<?php
namespace RecognitionVideoUrl\Controller;

use RecognitionVideoUrl\CheckerCollection;
use RecognitionVideoUrl\Recognizer;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class RecognitionController extends Controller
{
    public function run(Request $request)
    {
        $collection = $this->container->get(CheckerCollection::class);

        $data = $request->request->get('data');

        $optional = [
            'description' => $request->request->get('description'),
            'preview' => $request->request->get('preview')
        ];

        if ($data) {
            $recognizer = new Recognizer($collection);

            $result = $recognizer->parse($data);

            if (is_array($result) and $result['error'] == "Data doesn't match pattern") {
                return $this->render('/base.html.twig', array('data' => $result['data'], 'error' => $result['error']));
            }

            $json = $result->json($optional);

            if (isset($result->getErrors()['error']) and $result->getErrors()['error'] == 'Nothing found') {
                $response = JsonResponse::fromJsonString($json, 404);
            } else {
                $response = JsonResponse::fromJsonString($json);
            }

            return $response;
        }

       return $this->render('/base.html.twig', array());
    }

    public function api(Request $request)
    {
        $collection = $this->container->get(CheckerCollection::class);

        $data = $request->query->get('data');

        $optional = [
            'description' => $request->query->get('description'),
            'preview' => $request->query->get('preview')
        ];

        if ($data) {
            $recognizer = new Recognizer($collection);

            $result = $recognizer->parse($data);

            if (is_array($result) and $result['error'] == "Data doesn't match pattern") {
                return $this->json(['data' => $result['data'], 'error' => $result['error']], 400);;
            }

            $json = $result->json($optional);

            if (isset($result->getErrors()['error']) and $result->getErrors()['error'] == 'Nothing found') {
                $response = JsonResponse::fromJsonString($json, 404);
            } else {
                $response = JsonResponse::fromJsonString($json);
            }

            return $response;
        }

        return $this->json(['error' => "No requset"], 204);  
    }
}