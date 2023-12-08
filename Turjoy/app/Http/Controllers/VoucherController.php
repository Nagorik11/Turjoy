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
                        $fail("La reserva ". $value ." no existe en sistema");
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
            return back()->with('message', 'No hay asientos disponibles para el día seleccionado.');
        }
        if($request->seat_quantity > $result){
            return back()->with('message', 'No hay asientos disponibles para el día seleccionado.');
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
        $vouchers = Voucher::orderBy('date', 'asc')->get();
        if($vouchers->isEmpty()){
            return redirect()->back()->withErrors(['no_vouchers' => 'No hay reservas en el sistema']);
        }
        return view('reservationReport', [
            'vouchers' => $vouchers
        ]);
    }

    public function reportReservations(Request $request)
    {
        $this->validate($request,[
            'min_date' => ['date','nullable'],
            'max_date' => ['date','nullable'],
        ]);

        $min_date = $request->min_date;
        $max_date = $request->max_date;

        if($min_date==$max_date){
            if($min_date==null){
                $vouchers = Voucher::orderBy('date', 'asc')->get();
                return view('reservationReport')->with('vouchers',$vouchers);
            }
            return redirect()->back()->withErrors(['error' => 'La fecha de inicio y de término no pueden ser iguales']);

        }
        if($min_date == null){
            $vouchers = Voucher::where('date', '<', $max_date)->orderBy('date', 'asc')->get();
            // dd("min",$vouchers);
        }
        elseif($max_date==null){
            $vouchers = Voucher::where('date', '>', $min_date)->orderBy('date', 'asc')->get();
            // dd("max",$vouchers);
        }
        else{
            $vouchers = Voucher::whereBetween('date',[$min_date,$max_date])->orderBy('date', 'asc')->get();
            // dd("none",$vouchers);
            if($vouchers->isEmpty()){
                return redirect()->back()->withErrors(['error' => 'No se encontraron reservas dentro del rango seleccionado']);
            }

        }

        return view('reservationReport')->with('vouchers',$vouchers);
    }

};
