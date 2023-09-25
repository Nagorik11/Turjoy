<?php

namespace App\Imports;

use App\Models\DatosCargados;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;

class UsersImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $tarifa_base = str_replace(['$', ',', '.'], '', $row['tarifa_base']);

            // Convierte la cadena en un valor decimal
            $tarifa_base = (float) $tarifa_base;
            // Puedes realizar acciones con los datos, como crear registros en la base de datos, por ejemplo:
             DatosCargados::create([
                'origen' => $row['origen'],
                'destino' => $row['destino'],
                'cant_asientos' => $row['cantidad_de_asientos'],
                #'tarifa_base' => $row['tarifa_base']
                'tarifa_base' => $tarifa_base,
            
         ]);
       }
    }
  
};