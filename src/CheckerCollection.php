<?php
namespace RecognitionVideoUrl;

use RecognitionVideoUrl\Checker\CheckerInterface;

class CheckerCollection
{
    protected $collection = [];

    public function __construct()
    {
        $this->set('YouTube', new \RecognitionVideoUrl\Checker\YouTubeChecker());
        $this->set('Vimeo', new \RecognitionVideoUrl\Checker\VimeoChecker());
    }

    public function set(string $key, CheckerInterface $checker): CheckerCollection
    {
        $this->collection[$key] = $checker;

        return $this;
    }

    public function get(string $key): CheckerInterface
    {
        return $this->collection[$key];
    }

    public function getCollection(): array
    {
        return $this->collection;
    }

    public function identifyData(string $data)
    {
        foreach ($this->collection as $key => $value) {
            $identifycationURL = $this->collection[$key]->checkURL($data);
            $identifycationEmbed = $this->collection[$key]->checkEmbed($data);
        
            if ($identifycationURL) {
                return $identifycationURL;
            }

            if ($identifycationEmbed) {
                return $identifycationEmbed;
            }
        }

        return false;
    }
}