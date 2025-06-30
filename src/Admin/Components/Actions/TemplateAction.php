<?php

namespace SmartCms\Support\Admin\Components\Actions;

use Filament\Actions\Action;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconSize;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;

class TemplateAction extends Action
{
    public static function make(?string $name = 'template'): static
    {
        return parent::make($name)
            ->iconButton()
            ->icon(Heroicon::Square3Stack3d)
            ->size(Size::Small)
            ->iconSize(IconSize::Large)
            ->color(Color::Blue)
            ->tooltip(__('support::admin.template'));
    }
}
