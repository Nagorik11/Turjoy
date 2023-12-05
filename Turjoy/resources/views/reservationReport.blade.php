@extends('layouts.app-master')

@section('content')

    <div class="pt-5 rounded">
        <h3 class="my-6 font-bold text-3x1 uppercase">Reporte de reservas</h3>
        <form action="{{ route('report.reservations') }}" method="GET">
            @csrf
            <div class="d-flex flex justify-center  gap-4 my-4">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Fecha minima</span>
                    <input type="date" class="border border-2 rounded-end" name="min_date" id="min_date" class="">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Fecha maxima</span>
                    <input type="date" class="border border-2 rounded-end" name="max_date" id="max_date" class="">
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
        @error('min_date')
            <p class="relative alert rounded-lg" style="background-color: #ff8a80; color:black;">
                {{ $message }}
            </p>
        @enderror
        @error('max_date')
            <p class="relative alert rounded-lg" style="background-color: #ff8a80; color:black;">
                {{ $message }}
            </p>
        @enderror
        @if ($vouchers->count() > 0)
            @isset($vouchers)
                <table class="table border border-1" style="background-color: #EAEAEA">
                    <thead>
                        <tr>
                            <th class="border border-1">Codigo de reserva</th>
                            <th class="border border-1">Fecha de reserva</th>
                            <th class="border border-1">Dia de la reserva</th>
                            <th class="border border-1">Ciudad de origen</th>
                            <th class="border border-1">Ciudad de destino</th>
                            <th class="border border-1">Cantidad de asientos</th>
                            <th class="border border-1">Valor total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vouchers as $row)
                            <tr class="border border-1" style="background-color: #F4F4F4">
                                <td class="border border-1">{{ $row['code'] }}</td>
                                <td class="border border-1">{{ \Carbon\Carbon::parse($row['date'])->format('d/m/Y') }}</td>
                                <td class="border border-1">{{ \Carbon\Carbon::parse($row['created_at'])->format('d/m/Y') }}</td>
                                <td class="border border-1">{{ $row['origin'] }}</td>
                                <td class="border border-1">{{ $row['destiny'] }}</td>
                                <td class="border border-1">{{ $row['seat_quantity'] }}</td>
                                <td class="border border-1">{{ $row['base_rate'] * $row['seat_quantity'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endisset
        @else
            <p>No hay reservas en sistema</p>
        @endif
    </div>
@endsection
