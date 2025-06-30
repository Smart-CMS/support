<?php

namespace SmartCms\Support\Admin\Components\Tables;

use Filament\Tables\Columns\TextColumn;

class UpdatedAtColumn extends TextColumn
{
    public static function make(?string $name = 'updated_at'): static
    {
        return parent::make($name ?? 'updated_at')->label(__('support::admin.updated_at'))
            ->dateTime()
            ->sortable()
            ->since()
            ->toggleable(isToggledHiddenByDefault: false);
    }
}
