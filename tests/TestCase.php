<?php
namespace Hughwilly\HeyLoyalty\Tests;

use Hughwilly\HeyLoyalty\HeyLoyaltyServiceProvider;

class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    public function createApplication()
    {
        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';

        $app->register(HeyLoyaltyServiceProvider::class);

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

    public function setUp()
    {
        parent::setUp();

        $this->app['config']->set('heyloyalty.list_id','4719');
        $this->app['config']->set('heyloyalty.api_key','uhCj2gB00vUy236b');
        $this->app['config']->set('heyloyalty.secret','SXfS9gjznm42L6qfYlRSedSWciDgnevH');
    }
}