<?php

namespace SmartCms\Support\Admin\Components\Tables;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class NameColumn
{
    public const LIMIT = 30;

    public static function make(string $name = 'name'): TextColumn
    {
        return TextColumn::make('name')->limit(self::LIMIT)->tooltip(fn(Model $record): ?string => strlen($record->name) > self::LIMIT ? $record->name : null)->searchable()->label(__('support::admin.name'));
    }
}
