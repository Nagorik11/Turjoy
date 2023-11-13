<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TravelController;
use App\Models\Reservation;
use App\Models\Route;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class ReservationController extends Controller
{
    public function indexReservation()
    {
        return view('reservation');
    }
    
    public function showOrigins()
    {
        $routes = Route::all();
    
        return view('reservation', ['routes' => $routes]);
    }
    
    public function getDate()
    {
        $date = Reservation::d;
    
        return view('reservation', ['date' => $date]);
    }
  
    
}