<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;

class DatosCargados extends Model
{
    protected $table = 'datos_cargados'; // Nombre de la tabla

    protected $fillable = [
        'origen',
        'destino',
        'cant_asientos',
        'tarifa_base',
    ];
};