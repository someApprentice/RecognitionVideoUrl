<?php
namespace RecognitionVideoUrl\Parser;

use RecognitionVideoUrl\Entity\AbstractURL;
use RecognitionVideoUrl\Entity\AbstractResult;

interface ParserInterface
{
    public function parse(AbstractURL $url): AbstractResult;
}