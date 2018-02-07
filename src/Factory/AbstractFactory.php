<?php
namespace RecognitionVideoUrl\Factory;

use RecognitionVideoUrl\Entity\AbstractURL;

abstract class AbstractFactory
{
    abstract public function createEntityFromURL(string $url): AbstractURL;

    abstract public function createEntityFromEmbed(string $embed): AbstractURL;
}