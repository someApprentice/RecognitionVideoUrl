<?php
namespace RecognitionVideoUrl\Checker;

interface CheckerInterface
{
    public function checkURL(string $url);

    public function checkEmbed(string $embed);
}