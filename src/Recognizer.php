<?php
namespace RecognitionVideoUrl;

use RecognitionVideoUrl\CheckerCollection;

class Recognizer
{
    protected $collection;

    protected $config = [];

    public function __construct(CheckerCollection $collection)
    {
        $this->collection = $collection;

        $this->config = parse_ini_file(__DIR__ . '/../config/hosting_options.ini', true);
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function setConfig(array $config = []): Recognizer
    {
        $this->config = $config;

        return $this;
    }

    public function parse(string $data)
    {
        $identification = $this->collection->identifyData($data);

        if (!$identification) {
            return ['data' => $data, 'error' => "Data doesn't match pattern"];
        }

        $factory = "RecognitionVideoUrl\\Factory\\{$identification['hosting']}Factory";
        $factory = new $factory();

        switch ($identification['type']) {
            case "URL":
                $url = $factory->createEntityFromURL($data);

                break;

            case "embed":
                $url = $factory->createEntityFromEmbed($data);

                break;
        }

        $parser = "RecognitionVideoUrl\\Parser\\{$identification['hosting']}Parser";
        $parser = new $parser($this->config[$identification['hosting']]);

        $result = $parser->parse($url);

        return $result;
    }
}