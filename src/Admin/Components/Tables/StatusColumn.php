<?php

namespace SmartCms\Support\Admin\Components\Tables;

use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\ToggleColumn;

class StatusColumn
{
    public static function make(string $name = 'status'): Column
    {
        return ToggleColumn::make($name)
            ->label(__('support::admin.status'))
            ->sortable();
    }
}
