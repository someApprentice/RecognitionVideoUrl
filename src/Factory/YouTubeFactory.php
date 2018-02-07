<?php
namespace RecognitionVideoUrl\Factory;

use RecognitionVideoUrl\Factory\AbstractFactory;
use RecognitionVideoUrl\Entity\AbstractURL;
use RecognitionVideoUrl\Entity\YouTubeURL;

class YouTubeFactory extends AbstractFactory
{
    public function createEntityFromURL(string $url): AbstractURL
    {
        $matches = [];

        if (preg_match('/((watch\?v=)|(youtu.be\/))([\w\d]{11})/i', $url, $matches)) {
            $id = $matches[4];

            $url = new YouTubeURL();
            $url->setId($id);

            return $url;
        }

        throw new \Exception("Con't create a YouTubeURL entity: url pattern doesn't match");
    }

    public function createEntityFromEmbed(string $embed): AbstractURL
    {
        $matches = [];

        if (preg_match('/src=\"(https?:\/\/)?(www\.)?youtube\.com\/embed\/([\w\d]{11})\"/', $embed, $matches)) {
            $id = $matches[3];

            $url = new YouTubeURL();
            $url->setId($id);

            return $url;
        }

        throw new \Exception("Con't create a YouTubeURL entity: embed pattern doesn't match");
    }
}