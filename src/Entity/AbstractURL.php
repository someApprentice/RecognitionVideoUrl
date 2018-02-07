<?php
namespace RecognitionVideoUrl\Entity;

abstract class AbstractURL
{
    abstract public function getId(): string;

    abstract public function setId(string $id): AbstractURL;
}