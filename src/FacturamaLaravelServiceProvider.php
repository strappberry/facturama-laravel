<?php

namespace Strappberry\FacturamaLaravel;

use Illuminate\Support\ServiceProvider;

class FacturamaLaravelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../publishable/config/facturama-laravel.php', 'facturama-laravel'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../publishable/config/facturama-laravel.php' => config_path('facturama-laravel.php'),
        ], 'facturama-laravel');
    }
}
