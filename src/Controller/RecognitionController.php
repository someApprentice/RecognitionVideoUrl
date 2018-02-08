<?php
namespace RecognitionVideoUrl\Controller;

use RecognitionVideoUrl\HostingCollection;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class RecognitionController extends Controller
{
    public function run(Request $request, HostingCollection $collection)
    {
        $data = $request->request->get('data');

        $optional = [
            'description' => $request->request->get('description'),
            'preview' => $request->request->get('preview')
        ];

        if ($data) {
            $identification = $collection->identifyData($data);

            switch ($identification['type']) {
                case "URL":
                    $url = $collection->getCollection()[$identification['hosting']]['factory']->createEntityFromURL($data);

                    break;

                case "embed":
                    $url = $collection->getCollection()[$identification['hosting']]['factory']->createEntityFromEmbed($data);

                    break;

                default:
                    return $this->render('/base.html.twig', array('data' => $data, 'error' => "Data doesn't match pattern"));
            }

            $parser = $collection->getCollection()[$identification['hosting']]['parser'];

            $result = $parser->parse($url);

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

    public function api(Request $request, HostingCollection $collection)
    {
        $data = $request->query->get('data');

        $optional = [
            'description' => $request->query->get('description'),
            'preview' => $request->query->get('preview')
        ];

        if ($data) {
            $identification = $collection->identifyData($data);

            switch ($identification['type']) {
                case "URL":
                    $url = $collection->getCollection()[$identification['hosting']]['factory']->createEntityFromURL($data);

                    break;

                case "embed":
                    $url = $collection->getCollection()[$identification['hosting']]['factory']->createEntityFromEmbed($data);

                    break;

                default:
                    return $this->json(['data' => $data, 'error' => "Data doesn't match pattern"], 400);
            }

            $parser = $collection->getCollection()[$identification['hosting']]['parser'];

            $result = $parser->parse($url);

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