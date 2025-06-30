<?php

namespace SmartCms\Support\Admin\Components\Layout;

use Filament\Schemas\Components\Grid;

class LeftGrid extends Grid
{
    protected function setUp(): void
    {
        $this->columns(1)->columnSpan([
            '@sm' => 1,
            '@md' => 2,
            '@xl' => 3,
        ]);
    }
}
