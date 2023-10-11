<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoadedFiles extends Model
{
    protected $table = 'datos_cargados'; // Nombre de la tabla

    protected $fillable = [
        'origen',
        'destino',
        'cant_asientos',
        'tarifa_base',
    ];

    // Define relaciones o métodos personalizados según tus necesidades.

};
