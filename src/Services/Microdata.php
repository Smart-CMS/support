<?php

namespace SmartCms\Support\Services;

use SmartCms\Support\Microdata\MicrodataInterface;

class Microdata
{
    public static array $items = [];

    public static function add(MicrodataInterface $item): void
    {
        self::$items[] = $item;
    }

    public static function get(): array
    {
        return array_map(function ($item) {
            return $item->getDefinition();
        }, self::$items);
    }
}
