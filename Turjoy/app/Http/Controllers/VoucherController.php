<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
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

        if ($voucher)
        {
            return view('searchVoucher',['voucher' => $voucher]);
        }
    }
}
