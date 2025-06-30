<?php

namespace SmartCms\Support\Admin\Components\Layout;

use Filament\Schemas\Components\Grid;

class FormGrid
{
    public static function make(array $schema)
    {
        return Grid::make()
            ->gridContainer()
            ->columns([
                '@md' => 3,
                '@xl' => 3,
            ])
            ->schema($schema);
    }
}
