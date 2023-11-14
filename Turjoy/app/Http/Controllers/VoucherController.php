<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\RouteController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use App\Helpers\MyHelper;
use Illuminate\Database\Eloquent\Collection;

class VoucherController extends Controller
{
    public function indexVoucher()
    {
        return view('searchVoucher');
    }

    public function searchVoucher(Request $request)
    {
        //dd($request->input('search_code'));
        $message = errorMessages();
        $request->validate([
            'search_code' => 'required', //
        ],$message);
        $code = $request->input('search_code');
        //dd($code);
        //Busqueda en la BD del voucher
        $voucher = Voucher::where('code', $code)->first();

        if ($voucher) {
            return view('searchVoucher', ['voucher' => $voucher, 'cost' => ($voucher->base_rate*$voucher->seat_quantity)]);
        }
        else{
            $request->validate([
                'search_code' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $fail("la reserva ". $value ." no existe en sistema");
                    },
                ],
            ]);
            return redirect()->route("voucher.index")->with('error');
        }
    }
    

    public function voucherInformation()
    {
        return view('voucherInformation');
    }

    public function postView()
    {
        return view('postView');
    }
    public function store(Request $request)
    {
        $voucher = new Voucher();
        $voucher->code = $this->codeVoucherGen();
        $voucher->date = $request->input('date');
        $voucher->origin = $request->input('origin'); // Use input for both origin and destiny
        $voucher->destiny = $request->input('destiny');
        $voucher->seat_quantity = $request->input('seat_quantity');
        $voucher->base_rate = $this->getBaseRate($voucher->origin, $voucher->destiny); // Call the method with values
        $voucher->save();
        return redirect()->route('post.index');
    }
    public function getBaseRate($origin, $destiny)
    {
        $baseRate = Route::where('origin', $origin)
                        ->where('destiny', $destiny)
                        ->first();

        // If the base rate exists, return it as a numeric value
        if ($baseRate) {
            return $baseRate->base_rate;
        }

    }
    public function codeVoucherGen()
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
    
        $letterLength = strlen($letters);
        $numberLength = strlen($numbers);
    
        $code = '';
    
        // Generate 4 letters
        for ($i = 0; $i < 4; $i++) {
            $code .= $letters[rand(0, $letterLength - 1)];
        }
    
        // Generate 2 numbers
        for ($i = 0; $i < 2; $i++) {
            $code .= $numbers[rand(0, $numberLength - 1)];
        }
    
        return $code;
    }

};