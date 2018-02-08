<?php
namespace RecognitionVideoUrl\Parser;

use RecognitionVideoUrl\Parser\ParserInterface;
use RecognitionVideoUrl\Entity\AbstractURL;
use RecognitionVideoUrl\Entity\AbstractResult;
use RecognitionVideoUrl\Entity\VimeoResult;

use Vimeo\Vimeo;

class VimeoParser implements ParserInterface
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

    public function setOptions(array $options = []): VimeoParser
    {
        $this->options = $options;

        return $this;
    }

    public function parse(AbstractURL $url): AbstractResult
    {
        $result = new VimeoResult();

        if (isset($this->options['client_id']) and isset($this->options['client_secret'])) {
            $vimeo = new Vimeo($this->options['client_id'], $this->options['client_secret']);

            $token = $vimeo->clientCredentials();

            $vimeo->setToken($token['body']['access_token']);

            $json = $vimeo->request("/videos/{$url->getId()}");

            if ($json) {
                if (!isset($json['body']['error'])) {
                    $result->setTitle($json['body']['name']);
                    $result->setDescription($json['body']['description']);
                    $result->setPreview($json['body']['pictures']['sizes'][3]['link']);
                    $result->setEmbed($json['body']['embed']['html']);
                } else {
                    $result->setErrors(['error' => 'Nothing found']);
                }

                return $result;
            }

            throw new \Exception("Something went wrong in parsing stage");
        }

        throw new \Exception("Define your API key in a config/hosting_options.ini file! See config/hosting_options.ini.example for example");
    }
}