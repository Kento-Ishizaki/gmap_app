<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // urlを全てhttpsにする
    public function boot(UrlGenerator $url)
    {
        // $url->forceScheme('https');
        if (config('app.env') === 'production' || config('app.env') === 'staging') {
            \URL::forceSchema('https');
        }
    }
}
