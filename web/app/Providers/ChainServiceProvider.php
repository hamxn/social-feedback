<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Chain\Client;

class ChainServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('chain', function ($app) {
            return new Client(
                config('services.chain.domain')
            );
        });
    }
}
