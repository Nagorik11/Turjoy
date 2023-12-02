<?php

use Symfony\Contracts\Service\Attribute\Required;

function errorMessages()
{
    //Mensajes custom
    $message = [
        'archivo.required' => 'debe subir un archivo',
    ];
    return $message;
}
