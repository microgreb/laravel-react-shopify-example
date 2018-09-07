<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('least_one', function ($attribute, $value, $parameters, $validator) {
            dd('test');
            return count(array_filter($value, function ($var) use ($parameters) {
                return array_key_exists($parameters[0], $var);
            }));
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
