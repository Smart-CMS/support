<?php

namespace SmartCms\Support\Admin\Components\Filters;

use Filament\Tables\Filters\SelectFilter;

class StatusFilter
{
    public static function make(): SelectFilter
    {
        return SelectFilter::make('status')
            ->label(__('support::admin.status'))
            ->options([
                true => __('On'),
                false => __('Off'),
            ]);
    }
}
