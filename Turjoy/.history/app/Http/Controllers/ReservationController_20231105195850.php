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
    public function indexReservation()    {
        return view('reservation');
    }
    
    public function showOrigins(){
    $travelController = new TravelController();
    $origins = Origin::all();
        return view('reservation', compact('origins')->$);
    }

    public function showDestinations($origin){
        $travelController = new TravelController();
        $destinations = $travelController->getDestinations($origin);   
        return view('reservation', $destinations);
  //  return view('reservation', ['destinations' => $destinations]);
    }

    
    public function store(Request $request)
    {
        $reservation = new Reservation();
        $reservation->origin = $request->origen;
        $reservation->destination = $request->destino;
        $reservation->save();
        return redirect()->route('reservation.index');
    }
};