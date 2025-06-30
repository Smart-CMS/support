<?php

namespace SmartCms\Support\Admin\Components\Tables;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class NameColumn
{
    public static function make(string $name = 'name'): TextColumn
    {
        return TextColumn::make('name')->limit(30)->tooltip(fn (Model $record): string => $record->name)->searchable()->label(__('support::admin.name'));
    }
}
