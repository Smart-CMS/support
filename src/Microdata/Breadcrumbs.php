<?php

namespace SmartCms\Support\Microdata;

class Breadcrumbs implements MicrodataInterface
{
    public static function make(...$args): self
    {
        return new self(...$args);
    }

    public function __construct(
        public array $properties = [],
    ) {}

    public function getType(): string
    {
        return 'BreadcrumbList';
    }

    public function getDefinition(): array
    {
        return [
            'itemListElement' => array_map(function ($item, $key) {
                return [
                    '@type' => 'ListItem',
                    'position' => $key + 1,
                    'name' => $item['name'],
                    'item' => $item['link'],
                ];
            }, $this->properties),
        ];
    }
}
