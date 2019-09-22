<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RageConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        \App::bind('platform.config', function() {

            return new \App\Packages\System\RageConfig;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
