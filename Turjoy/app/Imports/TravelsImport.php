<?php

namespace App\Imports;

use App\Models\Travel;
use Maatwebsite\Excel\Concerns\ToModel;

class TravelsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Travel([
            //
        ]);
    }
}
