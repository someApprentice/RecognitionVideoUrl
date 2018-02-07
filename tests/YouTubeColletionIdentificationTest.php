<?php
use PHPUnit\Framework\TestCase;

use RecognitionVideoUrl\HostingCollection;


final class YouTubeCollectionIdentificationTest extends TestCase
{
    public function testURLChecking(): void
    {
        $collection = new HostingCollection();

        $link = "https://youtu.be/KRrNST9OAcA";

        $embed = '<iframe width="560" height="315" src="https://www.youtube.com/embed/KRrNST9OAcA" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

        $this->assertArraySubset(['hosting' => 'YouTube', 'type' => 'URL'], $collection->identifyData($link));

        $this->assertArraySubset(['hosting' => 'YouTube', 'type' => 'embed'], $collection->identifyData($embed));
    }
}