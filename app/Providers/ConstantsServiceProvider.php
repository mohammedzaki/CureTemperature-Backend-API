<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Constants\SessionKey;

class ConstantsServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        /*$this->app->singleton('App\Constants\SessionKey', function($app) {
            return new SessionKey();
        });*/
        
        $this->app->bind('SessionKey', function ($app) {
            return new SessionKey;
        });
        
        //$this->app->alias('SessionKey', 'App\Constants\SessionKey');
    }

}
