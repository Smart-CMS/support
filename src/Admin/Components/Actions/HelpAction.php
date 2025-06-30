<?php

namespace SmartCms\Support\Admin\Components\Actions;

use Filament\Actions\Action;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconSize;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;

class HelpAction
{
    public static function make(string $description = '', string $name = 'help'): Action
    {
        return Action::make($name)
            ->icon(Heroicon::OutlinedQuestionMarkCircle)
            ->size(Size::Small)
            ->iconSize(IconSize::Large)
            ->iconButton()
            ->color(Color::Blue)
            ->modalFooterActions([])
            ->modalDescription($description)
            ->tooltip(__('support::admin.help'));
    }
}
