<?php

namespace App\Providers;

use App\Mail\PatientCreated;
use App\Models\Patient;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*Schema::defaultStringLength(191);
        Patient::created(function($patient)
        {
            Mail::to($patient)->send(new PatientCreated($patient));
        });*/
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
