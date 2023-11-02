<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class PaymentController extends Controller
{
    public function indexPayment()
    {
        return view('payment');
    }

    
    public function paymentProcess(Request $request)
    {
        $payment = new Payment();
        $payment->payment_method = $request->payment_method;
        $payment->save();
        return redirect()->route('home.index');
    }
}