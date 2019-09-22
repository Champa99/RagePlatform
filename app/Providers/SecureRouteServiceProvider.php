<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SecureRouteServiceProvider extends ServiceProvider
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
		\App::bind('secure.route', function() {

            return new \App\Packages\System\SecureRoute;
        });
    }
}
