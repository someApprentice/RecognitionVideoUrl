<?php
use PHPUnit\Framework\TestCase;

use RecognitionVideoUrl\HostingCollection;


final class VimeoCollectionIdentificationTest extends TestCase
{
    public function testURLChecking(): void
    {
        $collection = new HostingCollection();

        $link = "https://vimeo.com/79911232";

        $embed = '<iframe src="https://player.vimeo.com/video/79911232" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

        $this->assertArraySubset(['hosting' => 'Vimeo', 'type' => 'URL'], $collection->identifyData($link));

        $this->assertArraySubset(['hosting' => 'Vimeo', 'type' => 'embed'], $collection->identifyData($embed));
    }
}