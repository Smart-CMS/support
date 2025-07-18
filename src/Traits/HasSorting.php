<?php

namespace SmartCms\Support\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasSorting
 */
trait HasSorting
{
    protected static function bootHasSorting(): void
    {
        static::addGlobalScope('sorted', function (Builder $builder) {
            $instance = new static;
            $instance->scopeSorted($builder);
        });
    }

    /**
     * Scope to order the results by sorting column.
     *
     * @param  Builder  $query  The query builder instance.
     * @return Builder The modified query builder.
     */
    public function scopeSorted(Builder $query): Builder
    {
        return $query->orderBy($this->getTable() . '.' . $this->getSortingColumn(), 'asc');
    }

    public function getSortingColumn(): string
    {
        return 'sorting';
    }
}
