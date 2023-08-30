<?php

namespace App\UI\Link;

class LinkData
{
    public function __construct(
        private readonly string $label,
        private readonly string $url,
        private readonly string $className
    ) {}

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getClassName(): string
    {
        return $this->className;
    }
}
