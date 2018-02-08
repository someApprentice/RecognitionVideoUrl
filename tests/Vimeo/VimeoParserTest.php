<?php
use PHPUnit\Framework\TestCase;

use RecognitionVideoUrl\Entity\VimeoUrl;
use RecognitionVideoUrl\Parser\VimeoParser;
use RecognitionVideoUrl\Entity\VimeoResult;

final class VimeoParserTest extends TestCase
{
    public function testVimeoParse(): void
    {
        $options = parse_ini_file(__DIR__ . '/../../config/hosting_options.ini', true)['Vimeo'];

        $parser = new VimeoParser($options);

        $url = new VimeoUrl();
        $url->setId('79911232');

        $result = $parser->parse($url);

        $this->assertInstanceOf(VimeoResult::class, $result);

        $this->assertEquals("Gretna Green Starling Murmurations", $result->getTitle());

        $this->assertEquals("This video is subject to copyright owned by Paul Bunyard-Wild About Images. Any reproduction or republication of all or part of this video is expressly prohibited, If you wish to use any part of this video then please contact Paul.\n\nNovember 2013\n\nCanon C100\nCanon 70-200 F2.8\nCanon 1.4 TC", $result->getDescription());

        $this->assertEquals("https://i.vimeocdn.com/video/455705525_640x360.jpg?r=pad", $result->getPreview());

        $this->assertEquals("<iframe src=\"https://player.vimeo.com/video/79911232?badge=0&autopause=0&player_id=0\" width=\"1280\" height=\"720\" frameborder=\"0\" title=\"Gretna Green Starling Murmurations\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>", $result->getEmbed());
    }
}