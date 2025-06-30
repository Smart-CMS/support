<?php

namespace SmartCms\Support\Admin\Components\Actions;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class SaveAndClose
{
    public static function make(Page $page, string $url): Action
    {
        return Action::make(__('support::admin.save_close'))
            ->label(__('support::admin.save_close'))
            ->icon(Heroicon::OutlinedCheckBadge)
            ->formId('form')
            ->action(function () use ($page, $url) {
                if (method_exists($page, 'getOwnerRecord')) {
                    $page->getOwnerRecord()->touch();
                    Notification::make('saved')
                        ->title(__('core::admin.saved'))
                        ->success()
                        ->send();
                } else {
                    $page->save(true, true);
                    $page->record->touch();
                }
                return redirect()->to($url);
            });
    }
}
