<?php
namespace RecognitionVideoUrl\Checker;

use RecognitionVideoUrl\Checker\CheckerInterface; 

class YouTubeChecker implements CheckerInterface
{
    public function checkURL(string $url)
    {
        if (preg_match('/(https?:\/\/)?(www\.)?((youtube\.com\/watch\?v=)|(youtu\.be\/))([\w\d]{11})/i', $url)) {
            return ['hosting' => 'YouTube', 'type' => 'URL'];
        }

        return false;
    }

    public function checkEmbed(string $embed)
    {
        if (preg_match('/<iframe(.)* src=\"(https?:\/\/)?(www\.)?youtube\.com\/embed\/([\w\d]{11})\"(.)*><\/iframe>/i', $embed)) {
            return ['hosting' => 'YouTube', 'type' => "embed"];
        }

        return false;
    }
}