<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bindRecursiveMacro();
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

    /**
     *  Bind Collection recursive macro
     *  Allows recursively convert Array or Object to Collection
     */
    private function bindRecursiveMacro()
    {
        \Illuminate\Support\Collection::macro('recursive', function () {
            return $this->map(function ($value) {
                if (is_array($value) || is_object($value)) {
                    return collect(json_decode(json_encode($value)))->recursive();
                }

                return $value;
            });
        });
    }
}
