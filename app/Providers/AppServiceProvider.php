<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\FabricShape;
use App\Observers\FabricShapeObserver;

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
    }
}
