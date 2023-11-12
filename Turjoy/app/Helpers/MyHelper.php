<?php

use Symfony\Contracts\Service\Attribute\Required;

function errorMessages()
{
    $message = [
        'archivo.required' => 'debe subir un un archivo',
        'archivo.mimes' => 'el archivo seleccionado no es Excel con extensión .xlsx',
        'archivo.max' => 'el tamaño máximo del archivo a cargar no puede superar los 5 megabytes',
        'archivo.string' => "El archivo no es valido",
        'archivo.required' => 'Debe subir un archivo',
        'archivo.mimes' => 'El archivo seleccionado no es Excel con extensión .xlsx',
        'archivo.max' => 'El tamaño máximo del archivo a cargar no puede superar los 5 megabytes',
        'archivo.string' => 'El archivo no es válido',
        'date.required' => 'Debe ingresar una fecha',
        'origin.required' => 'Debe ingresar una ciudad de origen',
        'destiny.required' => 'Debe ingresar una ciudad de destino',
        'search_code.required' => 'debe proporcionar un código de reserva',
    ];
    return $message;
}
