<?php

namespace App\Imports;

use App\Models\DatosCargados;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow
{
    protected $validRows = [];
    protected $invalidRows = [];
    protected $duplicatedRows = [];
    protected $existingOriginsdestinos = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $origen = $row['origen'];
            $destino = $row['destino'];
            
            if ($this->hasDuplicateOriginDestino($origen, $destino)) {
                $row['tarifa_base'] = str_replace(['$', ',', '.'], '', $row['tarifa_base']);
                
                if (isset($row['origen']) && isset($row['destino']) && isset($row['cantidad_de_asientos']) && isset($row['tarifa_base']) && is_numeric($row['cantidad_de_asientos']) && is_numeric($row['tarifa_base']) && $origen != $destino) {
                    $this->duplicatedRows[] = $row;
                    $row['type'] = '1';
                } else {
                    $this->invalidRows[] = $row;
                    $row['type'] = '2';
                }
            } else {
                $row['tarifa_base'] = str_replace(['$', ',', '.'], '', $row['tarifa_base']);
                
                if (isset($row['origen']) && isset($row['destino']) && isset($row['cantidad_de_asientos']) && isset($row['tarifa_base']) && is_numeric($row['cantidad_de_asientos']) && is_numeric($row['tarifa_base']) && $origen != $destino) {
                    $row['type'] = '0';
                    $this->validRows[] = $row;
                    $this->existingOriginsdestinos[] = $origen . '-' . $destino;
                } else {
                    $this->invalidRows[] = $row;
                    $row['type'] = '2';
                }
            }

            $tarifa_base = str_replace(['$', ',', '.'], '', $row['tarifa_base']);

            $tarifa_base = (float) $tarifa_base;

            DatosCargados::create([
                'origen' => $row['origen'],
                'destino' => $row['destino'],
                'cant_asientos' => $row['cantidad_de_asientos'],
                'type' => $row['type'],
                'tarifa_base' => $tarifa_base,
            ]);
        }
    }

    private function hasDuplicateOriginDestino($origen, $destino)
    {
        $key = $origen . '-' . $destino;
        return in_array($key, $this->existingOriginsdestinos);
    }

    public function getValidRows()
    {
        return $this->validRows;
    }

    public function getInvalidRows()
    {
        return $this->invalidRows;
    }

    public function getDuplicatedRows()
    {
        return $this->duplicatedRows;
    }
}
