<?php

namespace SmartCms\Support\Microdata;

interface MicrodataInterface
{
    public static function make(...$args): self;
    public function getType(): string;
    public function getDefinition(): array;
}
