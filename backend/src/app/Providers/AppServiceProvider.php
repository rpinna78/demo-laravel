<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ResponseService;

/** 
* ** DEMO-LARAVEL **
* classe AppServiceProvider
* implementta ServiceProvider
* inizializza la ResponseService custom del BE 
*/
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

        ResponseService::init();
    }
}
