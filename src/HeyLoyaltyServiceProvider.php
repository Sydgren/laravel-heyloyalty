<?php
namespace Hughwilly\HeyLoyalty;

use Hughwilly\HeyLoyalty\Contracts\HeyLoyalty as HeyLoyaltyContract;
use Illuminate\Support\ServiceProvider;

/**
 * HeyLoyalty API Client Service Provider.
 *
 * @package Hughwilly\HeyLoyalty
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
        if (function_exists('config_path')) {
            $publish_path = config_path('heyloyalty.php');
        } else {
            $publish_path = base_path('config/heyloyalty.php');
        }
        $this->publishes([__DIR__.'/config/heyloyalty.php' => $publish_path], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HeyLoyaltyContract::class, HeyLoyalty::class);
        $this->app->bind('heyloyalty', HeyLoyalty::class);
    }
}
