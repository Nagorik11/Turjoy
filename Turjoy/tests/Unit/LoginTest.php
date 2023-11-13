<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testSucessLogin()
    {
        $response = $this->post('login', [
            'email' => 'italo.donoso@ucn.cl',
            'password' => 'Turjoy91',
        ]);

        $response->assertStatus(302); // Verifica el código de estado de la respuesta (redirección)
        $response->assertRedirect('home');
    }
}
