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

    public function testSuccessSearchVucher()
    {
        $destiny = 'Tierra Media';
        $origin = 'Narnia';
        $route = Route::where('origin',$origin)
        ->where('destiny',$destiny)
        ->first();
        if(!$route){
            $route = Route::create([
                'origin'=> $origin,
                'destiny'=> $destiny,
                'seat_quantity'=> 40,
                'base_rate'=> '50000',
                'type'=> 0,
            ]);
        }
        //dd($route);

        $voucher = Voucher::create([
            'code' => 'XXX000',
            'date' => now(),
            'origin' => $route->origin,
            'destiny' => $route->destiny,
            'seat_quantity' => '10',
            'base_rate' => $route->base_rate,
        ]);
        $voucher->save();
        //dd($voucher);
        $response = $this->get('/voucher-search?search_code='. $voucher->code);

        $viewData = $response->original->getData();

        $voucher_responce = $viewData['voucher'];
        $cost_responce = $viewData['cost'];
        // dd($responseVoucher);

        $this->assertEquals($voucher->code, $voucher_responce->code);
    }
}
