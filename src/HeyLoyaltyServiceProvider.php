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
        //
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