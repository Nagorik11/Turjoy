<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
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
        // Realiza la búsqueda del voucher en función del código proporcionado.
        $voucher = Voucher::where('id', $request->id)->first();
    
        // Define el nombre de la vista y los datos que se pasarán a la vista.
        $viewName = 'voucherInformation';
        $viewData = $voucher ? ['voucher' => $voucher] : ['error' => 'No se encontró el voucher'];
    
        // Renderiza la vista con los datos apropiados.
        return view($viewName, $viewData);
    }
    

    public function voucherInformation()
    {
        return view('voucherInformation');
    }

    public function store(Request $request)
    {
        $voucher = new Voucher();
        $voucher->id = $this->codeVoucherGen();
        $voucher->date = $request->input('date');
                $voucher->origin = $request->origin;
        $voucher->destiny = $request->destiny;
        $voucher->seat_quantity = $request->seat_quantity;
        $voucher->base_rate = $request->base_rate;
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