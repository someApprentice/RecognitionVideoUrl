<?php
use PHPUnit\Framework\TestCase;

use RecognitionVideoUrl\Entity\YouTubeResult;

final class YouTubeResultTest extends TestCase
{
    public function testJsonResult(): void
    {
        $data = [
            'title' => "The Beautiful Awful | Alyssa Monks | TEDxIndianaUniversity",

            'description' =>  "Alyssa Monks describes the interaction of life, paint, and canvas through her development as an artist, and as a human.\n\nAlyssa Monks earned her B.A. from Boston College and she studied painting at Lorenzo de' Medici in Florence. She went on to complete her M.F.A at the New York Academy of Art, Graduate School of Figurative Art in 2001. She teaches and lectures at universities and institutions nation wide, and is an adjunct professor at the New York Academy of Art.\r\n\r\n\"My intention is to transfer the intimacy and vulnerability of my human experience into a painted surface. I like mine to be as intimate as possible, each brush stroke like a fossil, recording every gesture and decision.\"  \r\n\r\nMonks's paintings have been the subject of numerous solo and group exhibitions including \"Intimacy\" at the Kunst Museum in Ahlen, Germany and \"Reconfiguring the Body in American Art, 1820-2009\" at the National Academy Museum of Fine Arts, New York. Her work is represented in public and private collections, including the Savannah College of Arts, the Somerset Art Association and the collections of Howard Tullman.\n\nThis talk was given at a TEDx event using the TED conference format but independently organized by a local community. Learn more at http://ted.com/tedx",

            'preview' => "https://i.ytimg.com/vi/KRrNST9OAcA/default.jpg",

            'embed' => "<iframe width='560' height='315' src='https://www.youtube.com/embed/KRrNST9OAcA' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>"
        ];

        $result = new YouTubeResult();
        $result->setTitle($data['title']);
        $result->setDescription($data['description']);
        $result->setPreview($data['preview']);
        $result->setEmbed('KRrNST9OAcA');

        $json = json_decode($result->json(), true, 512, \JSON_OBJECT_AS_ARRAY);

        $this->assertArraySubset($data, $json);
    }
}