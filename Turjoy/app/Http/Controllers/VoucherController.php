<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ReservationController;

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
        //dd($request);
        $message = errorMessages();
        $request->validate([
            'search_code' => 'required', // Max 5MB
        ],$message);
        $code = $request->query('search_code');
        // dd($code);
        //Busqueda en la BD del voucher
        $voucher = Voucher::where('code', $code)->first();

        if ($voucher) {
            //dd($voucher->id);
            return view('searchVoucher', ['voucher' => $voucher, 'cost' => ($voucher->base_rate*$voucher->seat_quantity), 'code' => $code]);
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

    public function postView($code)
    {
        $voucher = Voucher::where('code', $code)->first();

        return view('postView', ['voucher' => $voucher]);
    }

    public function store(Request $request)
    {
        // Define las reglas de validación
        // dd($request);
        $rules = [
            'date' => 'required|date|after_or_equal:today',
            'origin' => 'required',
            'destiny' => 'required',
            'seat_quantity' => 'required|numeric|min:1',
        ];

        // Define mensajes personalizados para las reglas de validación (opcional)
        $messages = [
            'date.required' => 'Debe seleccionar la fecha del viaje antes de realizar la reserva.',
            'date.date' => 'El campo fecha debe ser una fecha válida.',
            'origin.required' => 'El campo origen es obligatorio.',
            'destiny.required' => 'El campo destino es obligatorio.',
            'seat_quantity.required' => 'El campo cantidad de asientos es obligatorio.',
        ];

        // Realiza la validación
        $request->validate($rules, $messages);
        $vouchers = Voucher::where('origin',$request->origin)->where('destiny',$request->destiny)->where('date',$request->date)->sum('seat_quantity');
        //dd($vouchers);
        $route = Route::where('origin',$request->origin)->where('destiny',$request->destiny)->first();
        //dif entre actuales y total
        $result = $route->seat_quantity - $vouchers;
        if($result == 0){
            return back()->with('message', 'No hay servicios disponibles para la ruta seleccionada.');
        }
        if($request->seat_quantity > $result){
            return back()->with('message', 'No hay servicios disponibles para la ruta seleccionada.');
        }
        $voucher = new Voucher();
        $voucher->code = $this->codeVoucherGen();
        $voucher->date = $request->input('date');
        $voucher->origin = $request->input('origin');
        $voucher->destiny = $request->input('destiny');
        $voucher->seat_quantity = $request->input('seat_quantity');
        $voucher->base_rate = $this->getBaseRate($voucher->origin, $voucher->destiny);
        $voucher->payment = $request->input('payment');
        $voucher->save();
        return redirect()->route('postView', ['code' => $voucher->code]);
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


    public function reservationReport()
    {
        $vouchers = Voucher::all();
        // if (session('vouchers_report')) {
        //     session()->put('vouchers_report', []);

        // } else {
        //     session(['vouchers_report' => []]);
        // }
        return view('reservationReport', [
            'vouchers' => $vouchers
        ]);
        // return view('reservationReport', ['vouchers_report' => session('vouchers_report')]);
    }

    public function reportReservations(Request $request)
    {
        //dd($request);
        // $message = errorMessages();
        // $request->validate([
        //     'min_date' => 'required|date', // Max 5MB
        //     'max_date' => 'required|date', // Max 5MB
        // ],$message);

        $this->validate($request,[
            'min_date' => ['required','date'],
            'max_date' => ['required','date'],
        ]);

        $min_date = $request->min_date;
        $max_date = $request->max_date;

        $vouchers = Voucher::whereBetween('date',[$min_date,$max_date])->orderBy('date', 'asc')->get();

        return view('reservationReport')->with('vouchers',$vouchers);
    }

};
