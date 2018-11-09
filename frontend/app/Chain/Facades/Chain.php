<?php

namespace App\Chain\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Chain\Client
 */
class Chain extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'chain';
    }
}
