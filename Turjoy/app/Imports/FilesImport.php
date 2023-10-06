<?php

namespace App\Imports;

use App\Models\FileUpload;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


/**
 * 
 */
class FilesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $origen = $row['origen'];
            $destino = $row['destino'];
            $cantidad_de_asientos = $row['cantidad_de_asientos'];
            $tarifa_base = (int) str_replace(['$', ',', '.',], '', $row['tarifa_base']);
            $type = ''; // Inicializamos $type aquí

            // Verificar si los campos requeridos están definidos y son válidos
            if (isset($origen, $destino, $cantidad_de_asientos, $tarifa_base) &&
                is_numeric($cantidad_de_asientos)&&is_numeric($tarifa_base)&&$tarifa_base>0&&$cantidad_de_asientos>0&&$origen !== $destino &&$type!=='1') {
                // Verificar duplicados en base a origen y destino
                $existingRecord = FileUpload::where('origen', $origen)
                    ->where('destino', $destino)
                    ->first();

                if ($existingRecord) {
                    // Registro duplicado
                    
                    $type = '1'; // Asignamos '1' a $type
                    //Actualizamos la cantidad de asientos del registro existente
                    $existingRecord->cant_asientos = $cantidad_de_asientos;
                    $existingRecord->tarifa_base = $tarifa_base;
                    $existingRecord->save();
                    } else {
                    // Nuevo registro
                    $type = '0'; // Asignamos '0' a $type
                }
            } else {
                // Registro inválido
                $type = '2'; // Asignamos '2' a $type
            }

            // Ahora, creamos el registro en la base de datos después de determinar el valor de $type
            FileUpload::create([
                'origen' => $origen,
                'destino' => $destino,
                'cant_asientos' => $cantidad_de_asientos,
                'type' => $type,
                'tarifa_base' => $tarifa_base,
            ]);
        }
    }
}