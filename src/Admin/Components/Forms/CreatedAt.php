<?php

namespace SmartCms\Support\Admin\Components\Forms;

use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\Operation;

class CreatedAt
{
    public static function make(?string $label = null): TextEntry
    {
        return Timestamp::make('created_at', $label ?? __('support::admin.created_at'))->hiddenOn(Operation::Create);
    }
}
