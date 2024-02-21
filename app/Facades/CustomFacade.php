<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CustomFacade extends Facade{
        /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'custom-service';
    }
}