<?php

namespace SmartCms\Support\Microdata;

use SmartCms\Support\Microdata\MicrodataInterface;

class Organization implements MicrodataInterface
{
    public static function make(...$args): self
    {
        return new self(...$args);
    }

    public function getType(): string
    {
        return 'Organization';
    }

    public function __construct(
        public string $name,
        public string $logo,
    ) {}

    public function getDefinition(): array
    {
        return [
            '@type' => 'Organization',
            'name' => $this->name,
            'url' => url('/'),
            'logo' => $this->logo,
            'contactPoint' => [],
        ];
    }
}
