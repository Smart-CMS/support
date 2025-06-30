<?php

namespace SmartCms\Support\Microdata;


class FaqPage implements MicrodataInterface
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
        return 'FAQPage';
    }

    public function getDefinition(): array
    {
        return array_map(function ($item) {
            return [
                '@type' => 'Question',
                'name' => $item['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $item['answer'],
                ],
            ];
        }, $this->properties);
    }
}
