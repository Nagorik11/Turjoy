<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Carbon\Traits\ToStringFormat;
use Illuminate\Http\Request;
use App\Imports\TravelsImport;
use Maatwebsite\Excel\Facades\Excel;

class TravelController extends Controller
{
<<<<<<< HEAD

    public function travelCheck(Request $request)
    {
=======
    public function indexAddTravels()
    {

        if (session('validRows') || session('invalidRows') || session('duplicatedRows')) {
            session()->put('validRows', []);
            session()->put('invalidRows', []);
            session()->put('duplicatedRows', []);
        } else {
            session(['validRows' => []]);
            session(['invalidRows' => []]);
            session(['duplicatedRows' => []]);
        }

        return view('importExportView', [
            'validRows' => session('validRows'),
            'invalidRows' => session('invalidRows'),
            'duplicatedRows' => session('duplicatedRows')
        ]);
    }

    public function indexTravels()
    {
        return view('importExportView', [
            'validRows' => session('validRows'),
            'invalidRows' => session('invalidRows'),
            'duplicatedRows' => session('duplicatedRows')
        ]);
    }

    public function travelCheck(Request $request)
    {
>>>>>>> 81f025e720e23d3ef07d6e093f54eeb2078857b5
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx|max:5120', // Max 5MB
        ]);

        try {
            $import = new TravelsImport;
            Excel::import($import, $request->file('archivo'));

            $validRows = $import->getValidRows();
            $invalidRows = $import->getInvalidRows();
            $duplicatedRows = $import->getDuplicatedRows();

            // BORRAR DEPUES -------------------------------------------------------------------
            //dd($validRows,$invalidRows,$duplicatedRows);
            foreach($validRows as $row)
            {

                $origin = $row['origen'];
                $destiny = $row['destino'];

                $travel = Travel::where('origin',$origin)
<<<<<<< HEAD
                    ->where('destiny',$destiny)
=======
                    ->where('destination',$destiny)
>>>>>>> 81f025e720e23d3ef07d6e093f54eeb2078857b5
                    ->first();
                if($travel)
                {
                    $travel->update([
                        'seats' => $row['cantidad_de_asientos'],
                        'base_rate' => $row['tarifa_base']
                    ]);
                }
                else
                {
                    Travel::create([
                        'origin'=> $origin,
                        'destiny'=> $destiny,
<<<<<<< HEAD
                        'seats'=> $row['cantidad_de_asientos'],
=======
                        'seats'=> ToStringFormat($row['cantidad_de_asientos']),
>>>>>>> 81f025e720e23d3ef07d6e093f54eeb2078857b5
                        'base_rate'=> $row['tarifa_base'],
                    ]);
                }
            }

            $invalidRows = array_filter($invalidRows, function ($invalidrow) {
                return $invalidrow['origen'] !== null || $invalidrow['destino'] !== null || $invalidrow['cantidad_de_asientos'] !== null || $invalidrow['tarifa_base'] !== null;
            });

            //dd(session('invalidRows'));

            session()->put('validRows', $validRows);
            session()->put('invalidRows', $invalidRows);
            session()->put('duplicatedRows', $duplicatedRows);

            //dd(count(session('validRows')), count(session('invalidRows')));

<<<<<<< HEAD
            return redirect()->route('importExportView')->with('success', 'El archivo se cargó correctamente.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('importExportView')->with('error', 'Error al importar el archivo: ' . $e->getMessage());
=======
            return redirect()->route('showLoadedFiles')->with('success', 'El archivo se cargó correctamente.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('showLoadedFiles')->with('error', 'Error al importar el archivo: ' . $e->getMessage());
>>>>>>> 81f025e720e23d3ef07d6e093f54eeb2078857b5
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Crear el product

        Travel::create([
            'id' => $request->id,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'date' => $request->date,
            'time' => $request->time,
            'price' => $request->price,
            'seat' => $request->seat,
        ]);


    }

<<<<<<< HEAD
}
=======
}
>>>>>>> 81f025e720e23d3ef07d6e093f54eeb2078857b5
