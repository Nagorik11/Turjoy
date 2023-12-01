@extends('layouts.app-master')

@section('content')

    <div class="bg-light p-5 rounded">
        @auth

        <p class="lead">Cargar rutas de viaje.</p>

        @error('archivo')
            <div class="alert alert-danger mt-3">
                <p class="m-0">{{ $message }}</p>
            </div>
        @enderror

        @if($allRows)

            <h2>Datos Cargados</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Cantidad de Asientos</th>
                        <th>Tarifa Base</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allRows as $row)
                    <tr style="background-color: {{ $row['type'] == 0 ? '#a8e6cf' : ($row['type'] == 2 ? '#ff8a80' : ($row['type'] == 1 ? '#e4e6a8' : '')) }}">
                            <td>{{ $row['origen'] }}</td>
                            <td>{{ $row['destino'] }}</td>
                            <td>{{ $row['cantidad_de_asientos'] }}</td>
                            <td>{{ $row['tarifa_base'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        @endauth
    </div>
@endsection

