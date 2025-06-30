<?php

namespace SmartCms\Support\Microdata;

class Website implements MicrodataInterface
{
    public static function make(...$args): self
    {
        return new self(...$args);
    }

    public function getType(): string
    {
        return 'WebSite';
    }

    public function __construct(
        public string $name,
        public string $logo,
    ) {}

    public function getDefinition(): array
    {
        return [
            '@type' => 'WebSite',
            'url' => url('/'),
        ];
    }
}
