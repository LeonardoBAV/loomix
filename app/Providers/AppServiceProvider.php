<?php

namespace App\Providers;

use App\Http\Responses\LoginResponse;
use App\Models\FabricShape;
use App\Observers\FabricShapeObserver;
use Filament\Http\Responses\Auth\Contracts\LoginResponse as FilamentLoginResponse;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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

        $this->app->singleton(
            FilamentLoginResponse::class,
            LoginResponse::class
        );

    }
}
