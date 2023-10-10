@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <p class="lead">Cargar rutas de viaje.</p>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('load-file') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="archivo">Selecciona un archivo XLSX:</label>
                <input type="file" name="archivo" id="archivo" accept=".xlsx">
            </div>
            <button type="submit" class="btn btn-primary">Cargar archivo</button>
        </form>

        <h2>Datos Cargados</h2>

        @if(isset($datosCargados) && count($datosCargados) > 0)
            <p>Se han cargado {{ count($datosCargados) }} registros.</p>
            
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
                    @foreach($datosCargados as $dato)
                    <tr style="background-color: {{ $dato->type == 0 ? '#a8e6cf' : ($dato->type == 2 ? '#ff8a80' : ($dato->type == 1 ? '#e4e6a8' : '')) }}">                            
                            <td>{{ $dato->origen }}</td>
                            <td>{{ $dato->destino }}</td>
                            <td>{{ $dato->cant_asientos }}</td>
                            <td>{{ $dato->tarifa_base }}</td>
                            <!-- Agrega más celdas si es necesario -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        @else
            <p>No hay datos cargados.</p>
        @endif

        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead"></p>
        @endguest
    </div>
@endsection