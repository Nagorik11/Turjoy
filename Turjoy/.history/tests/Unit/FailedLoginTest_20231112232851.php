<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FailedLoginTest extends TestCase{

public function testFailedLogin()
{
    $response = $this->post('login', [
        'email' => 'correo_inexistente@example.com', // Correo que no existe
        'password' => 'contraseña_incorrecta', // Contraseña incorrecta
    ]);

    $response->assertStatus(402); // Verifica el código de estado de la respuesta (redirección)
    $response->assertSessionHasErrors('email'); // Verifica que haya un error en el campo "email"
}
};