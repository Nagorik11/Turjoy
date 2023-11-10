<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;

use App\Models\Voucher;
use App\Models\Travel;
use App\Models\Payment;
use App\Models\Reservation;
use app\Imports\TravelsImport;



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
    /**
     * Voucher Routes
     */
    //Route::post('/voucher', 'VoucherController@searchVoucher')->name('voucher.search');
    Route::get('/voucher', [VoucherController::class,'indexVoucher'])->name('voucher.index');
   // Route::post('/search-voucher', [VoucherController::class,'searchVoucher'])->name('voucher.search');

    Route::get('/payment', [PaymentController::class,'indexPayment'])->name('payment.index');
    //Route::post('/payment', [PaymentController::class,'paymentProcess'])->name('payment.process');

    Route::get('/reservation', [ReservationController::class,'indexReservation'])->name('reservation.index');
    //Route::post('/reservation', [ReservationController::class,'showOrigins'])->name('reservation.origin');
    Route::get('/reservation', 'TravelController@getOrigins');

    /**
     * Guest Routes
     */
    Route::group(['middleware' => ['guest']], function() {

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
        /**
         * Voucher Routes
         */
        Route::get('/voucher', 'VoucherController@indexVoucher')->name('voucher.index');
        Route::post('/voucher-search','VoucherController@searchVoucher')->name('voucher.search');


    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        // Ruta para mostrar la vista de carga de archivos
        Route::get('/import', [ExcelController::class, 'importExportView'])->name('import-view');

        // Ruta para procesar la carga de archivos
        Route::post('/import', [TravelController::class, 'import'])->name('import-action');


        Route::get('/import-export', [TravelController::class, 'indexAddTravels'])->name('importExportView');
        Route::post('/load-file', [TravelController::class, 'travelCheck'])->name('travel.check');
        Route::get('/travel.index', [TravelController::class, 'indexTravels'])->name('travel.index');
    });


});

