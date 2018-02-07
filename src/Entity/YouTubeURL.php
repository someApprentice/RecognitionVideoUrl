<?php
namespace RecognitionVideoUrl\Entity;

use RecognitionVideoUrl\Entity\AbstractURL;

class YouTubeURL extends AbstractURL
{

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): AbstractURL
    {
        $this->id = $id;

        return $this;
    }
}