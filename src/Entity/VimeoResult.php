<?php
namespace RecognitionVideoUrl\Entity;

use RecognitionVideoUrl\Entity\AbstractResult;

class VimeoResult extends AbstractResult
{
    protected $title;

    protected $description;

    protected $embed;

    protected $preview;

    protected $errors = [];

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): AbstractResult
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): AbstractResult
    {
        $this->description = $description;

        return $this;
    }

    public function getEmbed(): string
    {
        return $this->embed;
    }

    public function setEmbed(string $embed): AbstractResult
    {
        $this->embed = $embed;
    
        return $this;
    }

    public function getPreview(): string
    {
        return $this->preview;
    }

    public function setPreview(string $preview): AbstractResult
    {
        $this->preview = $preview;

        return $this;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(array $errors = []): AbstractResult
    {
        $this->errors = $errors;

        return $this;
    }

    public function json(array $optional = []): string
    {
        $json = [];

        if (empty($this->errors)) {
            $json['title'] = $this->title;

            if (isset($optional['description']) and !is_null($optional['description'])) {
                $json['description'] = $this->description;
            }

            if (isset($optional['preview']) and !is_null($optional['preview'])) {
                $json['preview'] = $this->preview;
            }

            $json['embed'] = $this->embed;
        } else {
            $json = $this->errors;
        }

        return json_encode($json, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES);
    }
}