<?php

namespace SmartCms\Support\Traits;

/**
 * Trait HasBreadcrumbs
 */
trait HasBreadcrumbs
{
    /**
     * Get the breadcrumbs for the model.
     */
    abstract public function getBreadcrumbs(): array;
}
