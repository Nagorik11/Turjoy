<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Carbon\Traits\ToStringFormat;
use Illuminate\Http\Request;
use App\Imports\TravelsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\MyHelper;

class TravelController extends Controller
{
    public function indexAddTravels()
    {
        dd('indexAddTravels');
        if (session('validRows') || session('invalidRows') || session('duplicatedRows')||session()->put('allRows')) {
            session()->put('validRows', []);
            session()->put('invalidRows', []);
            session()->put('duplicatedRows', []);
            session()->put('allRows', []);
        } else {
            session(['validRows' => []]);
            session(['invalidRows' => []]);
            session(['duplicatedRows' => []]);
            session(['allRows' => []]);
        }

        //dd('Estoy en return view de travel controller');
        return view('importExportView', [
            'validRows' => session('validRows'),
            'invalidRows' => session('invalidRows'),
            'duplicatedRows' => session('duplicatedRows'),
            'allRows' => session('allRows')
        ]);
    }

    public function indexTravels()
    {
        //dd('indexTravels');
        //dd(session('allRows'));
        return view('importExportView', [
            'validRows' => session('validRows'),
            'invalidRows' => session('invalidRows'),
            'duplicatedRows' => session('duplicatedRows'),
            'allRows' => session('allRows')
        ]);
    }

    public function travelCheck(Request $request)
    {
        //dd('travelCheck');
        $message = errorMessages();
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx|max:5120', // Max 5MB
        ],$message);
        try {
            $import = new TravelsImport;
            Excel::import($import, $request->file('archivo'));

            $validRows = $import->getValidRows();
            $invalidRows = $import->getInvalidRows();
            $duplicatedRows = $import->getDuplicatedRows();
            $allRows = $import->getAllRows();

            // BORRAR DEPUES -------------------------------------------------------------------
            //dd($validRows,$invalidRows,$duplicatedRows,$allRows);
            //dd('antes del foreach');
            foreach($validRows as $row)
            {
                //dd('estoy en el foreach');
                $origin = $row['origen'];
                $destiny = $row['destino'];
                //dd($row);

                $travel = Route::where('origin',$origin)
                    ->where('destiny',$destiny)
                    ->first();
                if($travel)
                {
                    //dd($row);
                    //dd('estoy en el if de que existe un travel');
                    $travel->update([
                        'seat_quantity' => $row['cantidad_de_asientos'],
                        'base_rate' => $row['tarifa_base']
                    ]);
                    //dd($travel);
                }
                else
                {
                    //dd('estoy en el else de que no existe un travel');
                    Route::create([
                        'origin'=> $origin,
                        'destiny'=> $destiny,
                        'seat_quantity'=> $row['cantidad_de_asientos'],
                        'base_rate'=> $row['tarifa_base'],
                        'type'=> 0,
                    ]);
                }
                //dd('despues del  foreach');
            }
            //dd('despues del foreach');
            //dd('antes del array_filter');
            $invalidRows = array_filter($invalidRows, function ($invalidrow) {
                return $invalidrow['origen'] !== null || $invalidrow['destino'] !== null || $invalidrow['cantidad_de_asientos'] !== null || $invalidrow['tarifa_base'] !== null;
            });
            //dd('despues del array_filter');
            //dd(session('invalidRows'));
            // dd($allRows);
            session()->put('validRows', $validRows);
            session()->put('invalidRows', $invalidRows);
            session()->put('duplicatedRows', $duplicatedRows);
            session()->put('allRows', $allRows);

            //dd(count(session('validRows')), count(session('invalidRows')), count(session('duplicatedRows')), count(session('allRows')));

            return redirect()->route('travel.index')->with('success', 'El archivo se cargó correctamente.');
        }
        catch (\Exception $e) {
            dd($e);
            $request->validate([
                'archivo' => 'required|string|mimes:xlsx|max:5120', // Max 5MB
            ]);//,$message);
            return redirect()->back()->with('error');//, $message);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Crear el product

        Route::create([
            'id' => $request->id,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'date' => $request->date,
            'time' => $request->time,
            'price' => $request->price,
            'seat' => $request->seat,
        ]);

    }

    public function getOrigins()
    {
        $origins = Route::all();
        return view('reservation', ['origins' => $origins]);
    }



    public function getDestinations()
    {
        $destination
        return view('reservation', ['origins' => $origins]);
    }
}