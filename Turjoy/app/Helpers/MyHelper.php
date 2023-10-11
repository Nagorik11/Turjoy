<?php

use Symfony\Contracts\Service\Attribute\Required;

function errorMessages()
{
    $message = [
        'archivo.required' => 'debe subir un un archivo',
        'archivo.mimes' => '“el archivo seleccionado no es Excel con extensión .xlsx',
        'archivo.max' => '“el tamaño máximo del archivo a cargar no puede superar los 5 megabytes',
        'archivo.string' => "El archivo no es valido"
    ];
    return $message;
}
