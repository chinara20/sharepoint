<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // \Schema::defaultStringLength(191);
        // URL::forceScheme('https');
        // $this->app['request']->server->set('HTTPS','on');
        Carbon::setLocale(env('LOCALE', 'az'));
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
