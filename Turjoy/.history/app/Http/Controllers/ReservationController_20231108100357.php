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
        $travelController = new TravelController();
        //$origins = $travelController->getOrigins();
        $routes = $travelController->getOrigins();

        return view('reservation',$routes);
    }

  
    
}