<?php

namespace SmartCms\Support\Admin\Components\Forms;

use Filament\Forms\Components\Toggle;

class StatusField
{
    public static function make(string $name = 'status'): Toggle
    {
        return Toggle::make($name)
            ->label(__('support::admin.status'))
            ->default(true);
    }
}
