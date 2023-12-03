@extends('layouts.app-master')

@section('content')

    <div class="bg-light p-5 rounded">
        <h3 class="my-6 font-bold text-3x1 uppercase">Reporte de reservas</h3>
        <form action="{{ route('report.reservations') }}" method="POST">
            @csrf
            <div class="flex justify-center gap-4 my-4">
                <div class="relative max-w-sm gap-4 my-4">
                    <input type="date" name="min_date" id="min_date" class="">
                    @error('min_date')
                        <p class="relative alert rounded-lg" style="background-color: #ff8a80; color:black;">
                            {{ $message }}
                        </p>
                    @enderror
                    <input type="date" name="max_date" id="max_date" class="">
                    @error('max_date')
                        <p class="relative alert rounded-lg" style="background-color: #ff8a80; color:black;">
                            {{ $message }}
                        </p>
                    @enderror
    
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
        @if ($vouchers->count() > 0)
            @isset ($vouchers)
                <h2>Datos Cargados</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Codigo de reserva</th>
                            <th>Fecha de reserva</th>
                            <th>Dia de la reserva</th>
                            <th>Ciudad de origen</th>
                            <th>Ciudad de destino</th>
                            <th>Cantidad de asientos</th>
                            <th>Valor total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vouchers as $row)
                            <tr>
                                <td>{{ $row['code'] }}</td>
                                <td>{{ $row['date'] }}</td>
                                <td>{{ $row['created_at'] }}</td>
                                <td>{{ $row['origin'] }}</td>
                                <td>{{ $row['destiny'] }}</td>
                                <td>{{ $row['seat_quantity'] }}</td>
                                <td>{{ $row['base_rate'] * $row['seat_quantity'] }}</td>
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
