<?php

namespace SmartCms\Support;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SupportServiceProvider extends PackageServiceProvider
{
    public static string $name = 'support';

    public static string $viewNamespace = 'support';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)->hasTranslations();
    }
}
