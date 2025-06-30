<?php

namespace SmartCms\Support\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class SitemapManager
{
    protected string $sitemapPath;

    protected array $config;

    public function __construct()
    {
        $this->sitemapPath = public_path('sitemap.xml');
        $this->config = config('sitemap', []);
    }

    /**
     * Update sitemap entry for a model
     */
    public function updateEntry($model, string $action)
    {
        switch ($action) {
            case 'created':
            case 'updated':
                $this->addOrUpdateEntry($model);

                break;
            case 'deleted':
                $this->removeEntry($model);

                break;
        }

        $this->rebuildSitemap();
    }

    /**
     * Add or update sitemap entry
     */
    protected function addOrUpdateEntry($model)
    {
        if (! $model->shouldBeInSitemap()) {
            return;
        }

        $cacheKey = $this->getCacheKey($model);
        $config = $model->getSitemapConfig();

        Cache::put($cacheKey, $config, now()->addDays(30));
    }

    /**
     * Remove sitemap entry
     */
    protected function removeEntry($model)
    {
        $cacheKey = $this->getCacheKey($model);
        Cache::forget($cacheKey);
    }

    /**
     * Get cache key for model
     */
    protected function getCacheKey($model): string
    {
        return sprintf(
            'sitemap.%s.%s',
            strtolower(class_basename($model)),
            $model->getKey()
        );
    }

    /**
     * Rebuild entire sitemap
     */
    public function rebuildSitemap()
    {
        $entries = $this->collectAllEntries();
        $xml = $this->generateSitemapXml($entries);

        File::put($this->sitemapPath, $xml);

        // Clear cache after rebuild
        $this->clearSitemapCache();
    }

    /**
     * Collect all sitemap entries from cache and database
     */
    protected function collectAllEntries(): array
    {
        $entries = [];

        // Get entries from cache
        $cacheKeys = Cache::get('sitemap.cache_keys', []);
        foreach ($cacheKeys as $key) {
            $entry = Cache::get($key);
            if ($entry) {
                $entries[] = $entry;
            }
        }

        // Add static entries from config
        $staticEntries = $this->config['static_entries'] ?? [];
        $entries = array_merge($entries, $staticEntries);

        return $entries;
    }

    /**
     * Generate sitemap XML
     */
    protected function generateSitemapXml(array $entries): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($entries as $entry) {
            $xml .= '  <url>' . PHP_EOL;
            $xml .= '    <loc>' . htmlspecialchars($entry['url']) . '</loc>' . PHP_EOL;
            $xml .= '    <lastmod>' . $entry['lastmod'] . '</lastmod>' . PHP_EOL;
            $xml .= '    <changefreq>' . $entry['changefreq'] . '</changefreq>' . PHP_EOL;
            $xml .= '    <priority>' . $entry['priority'] . '</priority>' . PHP_EOL;
            $xml .= '  </url>' . PHP_EOL;
        }

        $xml .= '</urlset>';

        return $xml;
    }

    /**
     * Clear sitemap cache
     */
    protected function clearSitemapCache()
    {
        $cacheKeys = Cache::get('sitemap.cache_keys', []);
        foreach ($cacheKeys as $key) {
            Cache::forget($key);
        }
        Cache::forget('sitemap.cache_keys');
    }

    /**
     * Full sitemap regeneration from database
     */
    public function regenerateFromDatabase()
    {
        $this->clearSitemapCache();

        // Get all sitemap-aware models from config
        $models = $this->config['models'] ?? [];

        foreach ($models as $modelClass) {
            $query = $modelClass::query();

            $query->chunk(100, function ($models) {
                foreach ($models as $model) {
                    $this->addOrUpdateEntry($model);
                }
            });
        }

        $this->rebuildSitemap();
    }
}
