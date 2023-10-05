<?php

namespace App\Imports;

use App\Models\DatosCargados;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $origen = $row['origen'];
            $destino = $row['destino'];
            $cantidad_de_asientos = $row['cantidad_de_asientos'];
            $tarifa_base = (float) str_replace(['$', ',', '.'], '', $row['tarifa_base']);
            $type = ''; // Inicializamos $type aquí

            // Verificar si los campos requeridos están definidos y son válidos
            if (isset($origen, $destino, $cantidad_de_asientos, $tarifa_base) &&
                is_numeric($cantidad_de_asientos) &&$origen !== $destino ) {
                // Verificar duplicados en base a origen y destino
                $existingRecord = DatosCargados::where('origen', $origen)
                    ->where('destino', $destino)
                    ->first();

                if ($existingRecord) {
                    // Registro duplicado
                    $type = '1'; // Asignamos '1' a $type
                } else {
                    // Nuevo registro
                    $type = '0'; // Asignamos '0' a $type
                }
            } else {
                // Registro inválido
                $type = '2'; // Asignamos '2' a $type
            }

            // Ahora, creamos el registro en la base de datos después de determinar el valor de $type
            DatosCargados::create([
                'origen' => $origen,
                'destino' => $destino,
                'cant_asientos' => $cantidad_de_asientos,
                'type' => $type,
                'tarifa_base' => $tarifa_base,
            ]);
        }
    }
}