 <?php

namespace Sydgren\HeyLoyalty\Facades;

use Illuminate\Support\Facades\Facade;

class Dog extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'HeyLoyalty';
    }
}