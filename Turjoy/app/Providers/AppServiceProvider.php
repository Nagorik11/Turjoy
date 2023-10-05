<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        
    Validator::extend('not_empty', function ($attribute, $value, $parameters, $validator) {
        // Validar que el valor no esté vacío
        return !empty($value);
    });

    Validator::replacer('not_empty', function ($message, $attribute, $rule, $parameters) {
        // Personalizar el mensaje de error
        return str_replace(':attribute', $attribute, 'El campo :attribute es obligatorio.');
    });

    }
}
