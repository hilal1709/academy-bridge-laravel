<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Material;
use App\Observers\MaterialObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Material Observer disabled - soft delete feature removed
        // Material::observe(MaterialObserver::class);
    }
}
