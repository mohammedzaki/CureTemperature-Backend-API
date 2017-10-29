<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class CustomValidatorServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->startsWithValidator();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    private function startsWithValidator() {
        Validator::extend('startsWith', function ($attribute, $value, $parameters, $validator) {
            foreach ($parameters as $query) {
                if (substr($value, 0, strlen($query)) === $query) {
                    return TRUE;
                }
            }
            return FALSE;
        });

        Validator::replacer('startsWith', function ($message, $attribute, $rule, $parameters) {
            $st = implode(", or ", $parameters);
            return "The {$attribute} must starts with {$st}!";
        });
    }

}
