<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;
use App\Imports\TravelsImport;
use Maatwebsite\Excel\Facades\Excel;

class TravelController extends Controller
{

    public function travelCheck(Request $request)
    {
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
            dd($validRows,$invalidRows,$duplicatedRows);

            foreach($validRows as $row)
            {
                $origin = $row['origin'];
                $destiny = $row['destiny'];

                $travel = Travel::where('origin',$origin)
                    ->where('destination',$destiny)
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
                        'seats'=> $row['cantidad_de_asientos'],
                        'base_rate'=> $row['tarifa_base'],
                    ]);
                }


            }

            $invalidRows = array_filter($invalidRows, function ($invalidrow) {
                return $invalidrow['origen'] !== null || $invalidrow['destino'] !== null || $invalidrow['cantidad_de_asientos'] !== null || $invalidrow['tarifa_base'] !== null;
            });

            dd(session('invalidRows'));

            session()->put('validRows', $validRows);
            session()->put('invalidRows', $invalidRows);
            session()->put('duplicatedRows', $duplicatedRows);

            dd(count(session('validRows')), count(session('invalidRows')));

            return redirect()->route('importExportView')->with('success', 'El archivo se cargó correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('importExportView')->with('error', 'Error al importar el archivo: ' . $e->getMessage());
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
            'destiny' => $request->destiny,
            'date' => $request->date,
            'time' => $request->time,
            'price' => $request->price,
            'seat' => $request->seat,
        ]);


    }

}
