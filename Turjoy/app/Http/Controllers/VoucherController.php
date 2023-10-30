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
        $voucher = Voucher::where('code', $request->code)->first();
        if ($voucher) {
            return view('searchVoucher', ['voucher' => $voucher]);
        } else {
            return view('searchVoucher', ['error' => 'No se encontró el voucher']);
        }
    }
};