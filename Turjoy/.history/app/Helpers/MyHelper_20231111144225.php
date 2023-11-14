<?php

use Symfony\Contracts\Service\Attribute\Required;

function errorMessages()
{
    $message = [
        'archivo.required' => 'Debe subir un archivo',
        'archivo.mimes' => 'El archivo seleccionado no es Excel con extensión .xlsx',
        'archivo.max' => 'El tamaño máximo del archivo a cargar no puede superar los 5 megabytes',
        'archivo.string' => 'El archivo no es válido',
        'search_code.required' => 'Debe ingresar un código de reserva',
        'date.required' => 'Debe ingresar una fecha'
        'origin.required' => 'Debe ingresar una ciudad de origen',
        'destiny.required' => 'Debe ingresar una ciudad de destino',
    ];
    return $message;
}