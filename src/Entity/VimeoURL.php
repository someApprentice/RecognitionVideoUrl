<?php
namespace RecognitionVideoUrl\Entity;

use RecognitionVideoUrl\Entity\AbstractURL;

class VimeoURL extends AbstractURL
{
    protected $id;

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