<?php
namespace RecognitionVideoUrl\Parser;

use RecognitionVideoUrl\Parser\ParserInterface;
use RecognitionVideoUrl\Entity\AbstractURL;
use RecognitionVideoUrl\Entity\AbstractResult;
use RecognitionVideoUrl\Entity\YouTubeResult;

class YouTubeParser implements ParserInterface
{
    protected $options;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options = []): YouTubeParser
    {
        $this->options = $options;

        return $this;
    }

    public function parse(AbstractURL $url): AbstractResult
    {
        $result = new YouTubeResult();

        if (isset($this->options['key'])) {
            $json = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=id%2C+snippet&id={$url->getId()}&key={$this->options['key']}"), true, 512, \JSON_OBJECT_AS_ARRAY);

            if ($json) {
                if ($json['pageInfo']['totalResults'] == 1) {
                    $result->setTitle($json['items'][0]['snippet']['title']);
                    $result->setDescription($json['items'][0]['snippet']['description']);
                    $result->setPreview($json['items'][0]['snippet']['thumbnails']['default']['url']);
                    $result->setEmbed($url->getId());
                } else {
                    $result->setErrors(['result' => 'Nothing found']);
                }

                return $result;
            }

            throw new \Exception("Something went wrong in parsing stage");
        }

        throw new \Exception("Define your API key in a config/hosting_options.ini file! See config/hosting_options.ini.example for example");
    }
}