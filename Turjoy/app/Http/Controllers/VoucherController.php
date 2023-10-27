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
}
