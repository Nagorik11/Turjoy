<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;

<<<<<<<< HEAD:Turjoy/app/Http/Controllers/LoadedFilesController.php
class LoadedFiles extends Model
========
class FileUploadController extends Model
>>>>>>>> 81f025e720e23d3ef07d6e093f54eeb2078857b5:Turjoy/app/Http/Controllers/FileUploadController.php
{
    protected $table = 'datos_cargados'; // Nombre de la tabla

    protected $fillable = [
        'origen',
        'destino',
        'cant_asientos',
        'tarifa_base',
        'type',
    ];
<<<<<<<< HEAD:Turjoy/app/Http/Controllers/LoadedFilesController.php
};
========

    
};
>>>>>>>> 81f025e720e23d3ef07d6e093f54eeb2078857b5:Turjoy/app/Http/Controllers/FileUploadController.php
