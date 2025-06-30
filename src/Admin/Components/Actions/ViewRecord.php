<?php

namespace SmartCms\Support\Admin\Components\Actions;

use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;

class ViewRecord
{
    public static function make(): Action
    {
        return Action::make('_view')
            ->url(fn($record) => $record?->route() ?? url('/'))
            ->icon(Heroicon::OutlinedEye)
            ->iconButton()
            ->label(__('support::admin.view'))
            ->openUrlInNewTab(true);
    }
}
