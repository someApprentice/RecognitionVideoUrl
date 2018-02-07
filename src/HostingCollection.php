<?php
namespace RecognitionVideoUrl;

use RecognitionVideoUrl\Entity\URL;

class HostingCollection
{
    protected $collection;

    public function __construct()
    {
        $this->collection = [];

        $this->initCheckers();
        $this->initParsers();
        $this->initFactories();
        $this->initOptions();
    }

    public function getCollection(): array
    {
        return $this->collection;
    }

    public function initCheckers(): void
    {
        $files = glob(__DIR__ . '/Checker/*.php');

        foreach ($files as $file) {
            $matches = [];

            if (preg_match('/src\/Checker\/(\w+)Checker\.php/', $file, $matches)) {
                $name = $matches[1];

                $class = "RecognitionVideoUrl\\Checker\\{$name}Checker";

                $this->collection[$name]['checker'] = new $class();
            }
        }
    }

    public function initParsers(): void
    {
        $files = glob(__DIR__ . '/Parser/*.php');

        foreach ($files as $file) {
            $matches = [];

            if (preg_match('/src\/Parser\/(\w+)Parser\.php/', $file, $matches)) {
                $name = $matches[1];

                $class = "RecognitionVideoUrl\\Parser\\{$name}Parser";

                $this->collection[$name]['parser'] = new $class();
            }
        }
    }

    public function initFactories(): void
    {
        $files = glob(__DIR__ . '/Factory/*.php');

        foreach ($files as $file) {
            $matches = [];

            if (preg_match('/src\/Factory\/(?![Abstract])(\w+)(?=Factory\.php)/', $file, $matches)) {
                $name = $matches[1];

                $class = "RecognitionVideoUrl\\Factory\\{$name}Factory";

                $this->collection[$name]['factory'] = new $class();
            }
        }
    }

    public function initOptions(): void
    {
        $config =  parse_ini_file(__DIR__ . '/../config/hosting_options.ini', true);

        foreach ($config as $key => $options) {
            $this->collection[$key]['options'] = $options;

            $this->collection[$key]['parser']->setOptions($options);
        }
    }

    public function identifyData(string $data)
    {
        foreach ($this->collection as $key => $value) {
            $identifycationURL = $this->collection[$key]['checker']->checkURL($data);
            $identifycationEmbed = $this->collection[$key]['checker']->checkEmbed($data);
        
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