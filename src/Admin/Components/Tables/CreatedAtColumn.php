<?php

namespace SmartCms\Support\Admin\Components\Tables;

use Filament\Tables\Columns\TextColumn;

class CreatedAtColumn extends TextColumn
{
    public static function make(?string $name = 'created_at'): static
    {
        return parent::make($name ?? 'created_at')
            ->label(__('support::admin.created_at'))
            ->dateTime()
            ->sortable()
            ->since()
            ->toggleable(isToggledHiddenByDefault: true);
    }
}
