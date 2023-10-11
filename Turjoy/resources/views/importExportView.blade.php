@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <p class="lead">Cargar rutas de viaje.</p>

        {{-- @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif --}}

        <form action="{{ route('travel.check') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="archivo">Selecciona un archivo XLSX:</label>
                <input type="file" name="archivo" id="archivo" accept=".xlsx">
            </div>
            <button type="submit" class="btn btn-primary">Cargar archivo</button>
        </form>

        @error('archivo')
            <div class="alert alert-danger mt-3">
                {{ $message }}
            </div>
        @enderror
        @if($allRows)


            <h2>Datos Cargados</h2>

            {{-- @if(isset($datosCargados) && count($datosCargados) > 0) --}}
                {{-- <p>Se han cargado {{ count($datosCargados) }} registros.</p> --}}
            <p>Se han cargado {{ count($allRows) }} registros.</p>

            <table class="table">
                <thead>
                    <tr>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Cantidad de Asientos</th>
                        <th>Tarifa Base</th>
                        <!-- Agrega más columnas si es necesario -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($allRows as $row)
                    <tr style="background-color: {{ $row['type'] == 0 ? '#a8e6cf' : ($row['type'] == 2 ? '#ff8a80' : ($row['type'] == 1 ? '#e4e6a8' : '')) }}">
                            <td>{{ $row['origen'] }}</td>
                            <td>{{ $row['destino'] }}</td>
                            <td>{{ $row['cantidad_de_asientos'] }}</td>
                            <td>{{ $row['tarifa_base'] }}</td>
                            <!-- Agrega más celdas si es necesario -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead"></p>
        @endguest
    </div>
@endsection

