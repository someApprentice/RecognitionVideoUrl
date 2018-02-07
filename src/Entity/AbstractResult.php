<?php
namespace RecognitionVideoUrl\Entity;

abstract class AbstractResult
{
    abstract public function getTitle(): string;

    abstract public function setTitle(string $title): AbstractResult;

    abstract public function getDescription(): string;

    abstract public function setDescription(string $description): AbstractResult;

    abstract public function getEmbed(): string;

    abstract public function setEmbed(string $id): AbstractResult;

    abstract public function getPreview(): string;

    abstract public function setPreview(string $preview): AbstractResult;

    abstract public function json(): string;
}