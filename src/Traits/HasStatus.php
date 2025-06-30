<?php

namespace SmartCms\Support\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasStatus
 */
trait HasStatus
{
    public const STATUS_ON = 1;

    public const STATUS_OFF = 0;

    /**
     * Scope to filter active records.
     *
     * @param  Builder  $query  The query builder instance.
     * @return Builder The modified query builder.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where(self::getDb() . '.' . $this->getStatusColumn(), self::STATUS_ON);
    }

    /**
     * Scope to filter inactive records.
     *
     * @param  Builder  $query  The query builder instance.
     * @return Builder The modified query builder.
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where($this->getStatusColumn(), self::STATUS_OFF);
    }

    public function getStatusColumn(): string
    {
        return 'status';
    }
}
