@extends('layouts.app-master')

@section('content')
    <form action="{{ route('report.reservations') }}" method="GET">
        @csrf
        <div>
            <input type="date" name="min_date" id="min_date">
            <input type="date" name="max_date" id="max_date">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
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
@endsection
