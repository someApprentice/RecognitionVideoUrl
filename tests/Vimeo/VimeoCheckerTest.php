<?php
use PHPUnit\Framework\TestCase;

use RecognitionVideoUrl\Checker\VimeoChecker;

final class VimeoCheckerTest extends TestCase
{
    public function testURLChecking(): void
    {
        $checker = new VimeoChecker();

        $link = "https://vimeo.com/79911232";

        $this->assertArraySubset(['hosting' => 'Vimeo', 'type' => 'URL'], $checker->checkURL($link));
    }

    public function testEmbedChecking(): void
    {
        $checker = new VimeoChecker();

        $embed = '<iframe src="https://player.vimeo.com/video/79911232" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<p><a href="https://vimeo.com/79911232">Gretna Green Starling Murmurations</a> from <a href="https://vimeo.com/wildaboutimages">Paul Bunyard</a> on <a href="https://vimeo.com">Vimeo</a>.</p>';

        $this->assertArraySubset(['hosting' => 'Vimeo', 'type' => 'embed'], $checker->checkEmbed($embed));
    }
}