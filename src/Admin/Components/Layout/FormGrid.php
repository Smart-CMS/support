<?php

namespace SmartCms\Support\Admin\Components\Layout;

use Filament\Schemas\Components\Grid;

class FormGrid extends Grid
{
    protected function setUp(): void
    {
        $this->gridContainer()
            ->columns([
                '@md' => 3,
                '@xl' => 4,
            ])->columnSpanFull();
    }
}
