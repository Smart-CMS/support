<?php

namespace SmartCms\Support\Admin\Components\Forms;

use Filament\Forms\Components\TextInput;

class NameField
{
    public static function make(string $name = 'name'): TextInput
    {
        return TextInput::make($name)
            ->label(__('support::admin.name'))
            ->required()->reactive();
    }
}
