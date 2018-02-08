<?php
use PHPUnit\Framework\TestCase;

use RecognitionVideoUrl\Entity\VimeoResult;

final class VimeoResultTest extends TestCase
{
    public function testJsonResult(): void
    {
        $data = [
            'title' => "Gretna Green Starling Murmurations",

            'description' =>  "This video is subject to copyright owned by Paul Bunyard-Wild About Images. Any reproduction or republication of all or part of this video is expressly prohibited, If you wish to use any part of this video then please contact Paul.\n\nNovember 2013\n\nCanon C100\nCanon 70-200 F2.8\nCanon 1.4 TC",

            'preview' => "https://i.vimeocdn.com/video/455705525_640x360.jpg?r=pad",

            'embed' => "<iframe src=\"https://player.vimeo.com/video/79911232?badge=0&autopause=0&player_id=0\" width=\"1280\" height=\"720\" frameborder=\"0\" title=\"Gretna Green Starling Murmurations\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>"
        ];

        $result = new VimeoResult();
        $result->setTitle($data['title']);
        $result->setDescription($data['description']);
        $result->setPreview($data['preview']);
        $result->setEmbed($data['embed']);

        $json = json_decode($result->json(['description' => 'On', 'preview' => 'On']), true, 512, \JSON_OBJECT_AS_ARRAY);

        $this->assertArraySubset($data, $json);
    }
}