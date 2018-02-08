<?php
use PHPUnit\Framework\TestCase;

use RecognitionVideoUrl\Factory\VimeoFactory;
use RecognitionVideoUrl\Entity\VimeoURL;

final class VimeoFactoryTest extends TestCase
{
    public function testCreatingEntityFromURL(): void
    {
        $factory = new VimeoFactory();

        $link = "https://vimeo.com/79911232";

        $entity = $factory->createEntityFromURL($link);

        $this->assertInstanceOf(VimeoURL::class, $entity);

        $this->assertEquals('79911232', $entity->getId());
    }

    public function testCreatingEntityFromEmbed(): void
    {
        $factory = new VimeoFactory();

        $embed = '<iframe src="https://player.vimeo.com/video/79911232" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<p><a href="https://vimeo.com/79911232">Gretna Green Starling Murmurations</a> from <a href="https://vimeo.com/wildaboutimages">Paul Bunyard</a> on <a href="https://vimeo.com">Vimeo</a>.</p>';

        $entity = $factory->createEntityFromEmbed($embed);

        $this->assertInstanceOf(VimeoURL::class, $entity);

        $this->assertEquals('79911232', $entity->getId());
    }
}