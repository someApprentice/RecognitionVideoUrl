<?php
namespace RecognitionVideoUrl;

use RecognitionVideoUrl\Checker\CheckerInterface;

class CheckerCollection
{
    protected $collection = [];

    public function __construct(iterable $checkers)
    {
        foreach ($checkers as $checker) {
            $matches = [];

            if (preg_match('/RecognitionVideoUrl\\\\Checker\\\\(\w+)Checker/', get_class($checker), $matches)) {
                $key = $matches[1];

                $this->set($key, $checker);
            }
        }
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