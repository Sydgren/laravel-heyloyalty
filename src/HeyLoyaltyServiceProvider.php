<?php
namespace Sydgren\HeyLoyalty;

use Illuminate\Support\ServiceProvider;

/**
 * HeyLoyalty API Client Service Provider.
 *
 * @package Sydgren\HeyLoyalty
 */
class HeyLoyaltyServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/heyloyalty.php' => config_path('heyloyalty.php')
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('heyloyalty', 'Sydgren\HeyLoyalty\HeyLoyalty');
    }
}
