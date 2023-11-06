<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;


class VoucherController extends Controller
{
    public function indexVoucher()
    {
        return view('searchVoucher');
    }

    public function searchVoucher(Request $request)
    {


        $code = $request->input('search_code');

        //Busqueda en la BD del voucher
        $voucher = Voucher::where('id', $code)->first();

        if ($voucher) {
            $route = Route::find($voucher->Route_id);

            if ($route) {

                return view('searchVoucher', ['voucher' => $voucher, 'route' => $route]);
            }
        }
        else{
            $request->validate([
                'search_code' => 'required', // Max 5MB
            ]);
            return redirect()->route("voucher.index",)->with('error');
        }
    }

    public function voucherInformation()
    {
        return view('voucherInformation');
    }

    public function store(Request $request)
    {
        $voucher = new Voucher();
        $voucher->id = $this->codeVoucherGen();
        $voucher->travel_id = $request->travel_id;
        $voucher->origin = $request->origin;
        $voucher->destination = $request->destination;
        $voucher->seats = $request->seats;
        $voucher->total_cost = $request->total_cost;
        $voucher->save();
        return redirect()->route('voucher.index');
    }

    public function codeVoucherGen()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $code = '';
        for ($i = 0; $i < 10; $i++) {
            $code .= $characters[rand(0, $charactersLength - 1)];
        }
        return $code;
    }

}
