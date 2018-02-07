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

            $response = JsonResponse::fromJsonString($result->json());

            return $response;
        }

       return $this->render('/base.html.twig', array());
    }
}