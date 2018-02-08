<?php
use PHPUnit\Framework\TestCase;

use RecognitionVideoUrl\Factory\YouTubeFactory;
use RecognitionVideoUrl\Entity\YouTubeURL;

final class YouTubeFactoryTest extends TestCase
{
    public function testCreatingEntityFromURL(): void
    {
        $factory = new YouTubeFactory();

        $link = "https://youtu.be/KRrNST9OAcA";

        $entity = $factory->createEntityFromURL($link);

        $this->assertInstanceOf(YouTubeURL::class, $entity);

        $this->assertEquals('KRrNST9OAcA', $entity->getId());
    }

    public function testCreatingEntityFromEmbed(): void
    {
        $factory = new YouTubeFactory();

        $embed = '<iframe width="560" height="315" src="https://www.youtube.com/embed/KRrNST9OAcA" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

        $entity = $factory->createEntityFromEmbed($embed);

        $this->assertInstanceOf(YouTubeURL::class, $entity);

        $this->assertEquals('KRrNST9OAcA', $entity->getId());
    }
}