<?php
namespace RecognitionVideoUrl\Factory;

use RecognitionVideoUrl\Factory\AbstractFactory;
use RecognitionVideoUrl\Entity\AbstractURL;
use RecognitionVideoUrl\Entity\VimeoURL;

class VimeoFactory extends AbstractFactory
{
    public function createEntityFromURL(string $url): AbstractURL
    {
        $matches = [];

        if (preg_match('/vimeo\.com\/([\d]+)/i', $url, $matches)) {
            $id = $matches[1];

            $url = new VimeoURL();
            $url->setId($id);

            return $url;
        }

        throw new \Exception("Con't create a VimeoURL entity: url pattern doesn't match");
    }

    public function createEntityFromEmbed(string $embed): AbstractURL
    {
        $matches = [];

        if (preg_match('/src=\"(https?:\/\/)?(www\.)?player\.vimeo\.com\/video\/([\d]+)\"/i', $embed, $matches)) {
            $id = $matches[3];

            $url = new VimeoURL();
            $url->setId($id);

            return $url;
        }

        throw new \Exception("Con't create a VimeoURL entity: embed pattern doesn't match");
    }
}