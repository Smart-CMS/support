<?php

namespace SmartCms\Support\Admin\Components\Tables;

use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;

class SortingColumn
{
    public static function make(string $name = 'sorting'): Column
    {
        return TextColumn::make($name)
            ->label(__('support::admin.sorting'))
            ->toggleable()
            ->badge()
            ->color('gray')
            ->sortable()
            ->numeric();
    }
}
