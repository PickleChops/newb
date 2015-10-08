<?php

/**
 * User: bstratton
 * Date: 20/09/15
 * Time: 21:53
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Predis\Client;

class RedisServiceProvider extends ServiceProvider
{
    /**
     * Register redis connection in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Predis\Client', function ($app) {
            return new Client(array(
                'host'  =>  env('REDIS_HOST'),
                'port'  =>  env('REDIS_PORT')
            ));
        });
    }
}