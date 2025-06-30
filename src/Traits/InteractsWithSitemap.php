<?php

namespace SmartCms\Support\Traits;

trait InteractsWithSitemap
{
    use HasRoute;

    protected function bootInteractsWithSitemap(): void
    {
        static::created(function ($model) {
            $model->updateSitemap('created');
        });

        static::updated(function ($model) {
            $model->updateSitemap('updated');
        });

        static::deleted(function ($model) {
            $model->updateSitemap('deleted');
        });
    }

    public function updateSitemap(): void
    {
        if (! $this->shouldUpdateSitemap()) {
            return;
        }

        dispatch(function () {
            app(SitemapManager::class)->updateEntry($this);
        })->afterResponse();
    }

    public function shouldBeInSitemap(): bool
    {
        return true;
    }

    public function getSitemapConfig(): array
    {
        return [
            'url' => $this->route(),
            'priority' => 0.5,
            'changefreq' => 'monthly',
            'lastmod' => $this->updated_at->toISOString(),
        ];
    }
}
