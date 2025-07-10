<?php

namespace SmartCms\Support\Admin\Components\Forms;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class SlugField
{
    public static function make(string $name = 'slug'): TextInput
    {
        return TextInput::make($name)
            ->label(__('support::admin.slug'))
            ->unique(ignoreRecord: true)
            ->readOnlyOn('edit')
            ->required()->reactive()
            ->default('')->hintActions([
                Action::make('clear_slug')
                    ->label(__('support::admin.clear'))
                    ->requiresConfirmation()
                    ->icon('heroicon-o-trash')
                    ->action(function (Set $set) {
                        $set('slug', null);
                    }),
                Action::make('generate_slug')
                    ->label(__('support::admin.generate'))
                    ->icon('heroicon-o-arrow-path')
                    ->action(function (Set $set, $get) {
                        $name = $get('name') ?? '';
                        $slug = '';
                        if (is_string($name)) {
                            $slug = Str::slug($name);
                        }
                        if (is_array($name)) {
                            /**@phpstan-ignore-next-line */
                            $slug = Str::slug($name[main_lang()]);
                        }
                        $set('slug', $slug);
                    }),
            ]);
    }
}
