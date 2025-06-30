<?php

namespace SmartCms\Support\Admin\Components\Layout;

use Filament\Schemas\Components\Grid;

class RightGrid extends Grid
{
    protected function setUp(): void
    {
        $this->columns(1)->columnSpan(1);
    }
}
