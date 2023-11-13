<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Voucher;
use App\Models\Route;

class SearchVoucherTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccessSearchVoucher()
    {
        $destiny = 'Tierra Media';
        $origin = 'Narnia';
        $route = Route::create([
            'origin'=> $origin,
            'destiny'=> $destiny,
            'seat_quantity'=> 40,
            'base_rate'=> '50000',
            'type'=> 0,
        ]);
        $voucher = Voucher::create([
            'code' => 'XXX000',
            'date' => now()->toDateString(),
            'origin' => $route->origin,
            'destiny' => $route->destiny,
            'seat_quantity' => '10',
            'base_rate' => $route->base_rate,
        ]);
        $voucher->save();
        $response = $this->get('/voucher-search?search_code='. $voucher->code);
        $viewData = $response->original->getData();
        $voucher_responce = $viewData['voucher'];
        $cost_responce = $viewData['cost'];

        $this->assertEquals($voucher->code, $voucher_responce->code);
        $this->assertEquals($voucher->date, $voucher_responce->date);
        $this->assertEquals($voucher->origin, $voucher_responce->origin);
        $this->assertEquals($voucher->destiny, $voucher_responce->destiny);
        $this->assertEquals($voucher->seat_quantity, $voucher_responce->seat_quantity);
        $this->assertEquals($voucher->base_rate * $voucher->seat_quantity, $cost_responce);
    }

    public function testSearchVoucherNonExistent()
    {
        $value = 'ABCDEF123';

        //Simular una solicitud con datos inválidos
        $response = $this->get('/voucher-search?search_code='. $value);

        //Acceder a los mensajes de error
        $errors = session('errors');

        //Verificar que existe un mensaje de error específico
        $this->assertArrayHasKey('search_code', $errors->getMessages());
        $this->assertContains('la reserva '. $value. ' no existe en sistema', $errors->get('search_code'));
    }
}
