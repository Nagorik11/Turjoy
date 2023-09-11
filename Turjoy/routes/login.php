<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticaciÃ³n generadas automÃ¡ticamente por Auth::routes()
Auth::routes();