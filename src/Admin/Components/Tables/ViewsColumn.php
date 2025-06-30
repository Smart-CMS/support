<?php

namespace SmartCms\Support\Admin\Components\Tables;

use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;

class ViewsColumn
{
    public static function make(string $name = 'views'): Column
    {
        return TextColumn::make($name)
            ->label(__('support::admin.views'))
            ->badge()
            ->sortable()
            ->toggleable()
            ->numeric();
    }
}
