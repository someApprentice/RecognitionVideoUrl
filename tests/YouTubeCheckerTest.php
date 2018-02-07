<?php
use PHPUnit\Framework\TestCase;

use RecognitionVideoUrl\Checker\YouTubeChecker;

final class YouTubeCheckerTest extends TestCase
{
    public function testURLChecking(): void
    {
        $checker = new YouTubeChecker();

        $link = "https://youtu.be/KRrNST9OAcA";

        $this->assertArraySubset(['hosting' => 'YouTube', 'type' => 'URL'], $checker->checkURL($link));
    }

    public function testEmbedChecking(): void
    {
        $checker = new YouTubeChecker();

        $embed = '<iframe width="560" height="315" src="https://www.youtube.com/embed/KRrNST9OAcA" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

        $this->assertArraySubset(['hosting' => 'YouTube', 'type' => 'embed'], $checker->checkEmbed($embed));
    }
}