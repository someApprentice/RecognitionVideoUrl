<?php
namespace RecognitionVideoUrl\Checker;

use RecognitionVideoUrl\Checker\CheckerInterface; 

class VimeoChecker implements CheckerInterface
{
    public function checkURL(string $url)
    {
        if (preg_match('/(https?:\/\/)?(www\.)?vimeo\.com\/([\d]+)/i', $url)) {
            return ['hosting' => 'Vimeo', 'type' => 'URL'];
        }

        return false;
    }

    public function checkEmbed(string $embed)
    {
        if (preg_match('/<iframe(.)* src=\"(https?:\/\/)?(www\.)?player\.vimeo\.com\/video\/([\d]+)\"(.)*><\/iframe>/i', $embed)) {
            return ['hosting' => 'Vimeo', 'type' => "embed"];
        }

        return false;
    }
}