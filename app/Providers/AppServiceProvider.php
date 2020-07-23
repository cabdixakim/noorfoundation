<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        //tailwind pagination styles
        Paginator::useTailwind();

        // force https on all URLs when in production environment:
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        Schema::defaultStringLength(191);
    }
}
