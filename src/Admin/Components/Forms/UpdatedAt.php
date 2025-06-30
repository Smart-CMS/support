<?php

namespace SmartCms\Support\Admin\Components\Forms;

use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\Operation;

class UpdatedAt
{
    public static function make(?string $label = null): TextEntry
    {
        return Timestamp::make('updated_at', $label ?? __('support::admin.updated_at'))->hiddenOn(Operation::Create);
    }
}
