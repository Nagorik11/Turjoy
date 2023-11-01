<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\Route;
use Illuminate\Http\Request;

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
            // $request->validate([
            //     'search_code' => 'required', // Max 5MB
            // ]);
            return redirect()->route("voucher.index",)->with('error');
        }
    }
}
