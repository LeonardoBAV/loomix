<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\FabricShape;
use App\Observers\FabricShapeObserver;
use Illuminate\Support\Facades\URL;


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
        FabricShape::observe(FabricShapeObserver::class);

        if (config('app.force_https')) {
            URL::forceScheme('https');
        }

    }
}
