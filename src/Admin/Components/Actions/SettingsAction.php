<?php

namespace SmartCms\Support\Admin\Components\Actions;

use Filament\Actions\Action;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconSize;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;

class SettingsAction extends Action
{
    public static function make(?string $name = 'settings'): static
    {
        return parent::make($name)
            ->icon(Heroicon::Cog6Tooth)
            ->iconSize(IconSize::Large)
            ->iconButton()
            ->size(Size::Large)
            ->color(Color::Blue)
            ->tooltip(__('support::admin.settings'));
    }
}
