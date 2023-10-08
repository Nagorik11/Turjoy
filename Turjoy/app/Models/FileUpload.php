<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

<<<<<<<< HEAD:Turjoy/app/Models/LoadedFiles.php
class LoadedFiles extends Model
========
class FileUpload extends Model
>>>>>>>> 81f025e720e23d3ef07d6e093f54eeb2078857b5:Turjoy/app/Models/FileUpload.php
{
    
    protected $table = 'datos_cargados'; // Nombre de la tabla

    protected $fillable = [
        'origen',
        'destino',
        'cant_asientos',
        'tarifa_base',
        'type',
    ];

    // Define relaciones o métodos personalizados según tus necesidades.

};
