<?php

namespace SmartCms\Support\Traits;

/**
 * Trait HasParent
 */
trait HasParent
{
    /**
     * Get the parent relationship.
     */
    abstract public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo;

    /**
     * Get the cached parent relationship.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getCachedParent()
    {
        return $this?->parent;
    }
}
