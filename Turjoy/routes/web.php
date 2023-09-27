<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ExcelController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/home', 'HomeController@index')->name('home.index');


    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        //revisar
        Route::post('/cargar-archivo', 'ExcelController@cargarArchivo')->name('cargar-archivo');

        // Ruta para mostrar la vista de carga de archivos
        Route::get('/import', [ExcelController::class, 'importExportView'])->name('import-view');

        // Ruta para procesar la carga de archivos
        #Route::post('/import', [ExcelController::class, 'import'])->name('import-action');

        // Ruta para mostrar la vista de exportación de archivos
        Route::get('/import-export', 'ExcelController@importExportView')->name('importExportView');
        Route::post('/cargar-archivo', 'ExcelController@cargarArchivo')->name('cargar-archivo');

        Route::get('/mostrar-datos-cargados', 'ExcelController@mostrarDatosCargados')->name('mostrar-datos-cargados');
    });
    
    
});

