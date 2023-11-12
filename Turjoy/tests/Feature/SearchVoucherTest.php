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

    public function test_search_voucher_nonexistent()
    {
        $value = ABCDEF123;

        //Simular una búsqueda con un código de reserva que no existe
        $response = $this->get('/voucher-search',$value);

        // Asegurarse de que la respuesta contenga el mensaje de error
        $response->assertSee("la reserva ". $value ." no existe en sistema");
    }
}