@extends('layouts.app-master')

@section('content')
    <style>
        #custom-button {
            border-width: 1px;
        }

        #file-input {
            display: none;
        }

        #file-input-container {
            margin-bottom: 10px;
        }

        .card {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>

    @auth
        <div class="card">
            <h1>Cargar rutas</h1>
            <hr>


            <form action="{{ route('travel.check') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="file-input-container">
                    <input type="file" name="archivo" id="file-input" accept=".xlsx" hidden="hidden">
                    <button type="button" id="custom-button">Escoge un archivo</button>
                    <span id="custom-text">No has seleccionado ningún archivo</span>
                </div>
                <button type="submit" class="btn btn-primary">Cargar archivo</button>
            </form>
            @error('archivo')
                <div class="alert alert-danger mt-3">
                    <p class="m-0">{{ $message }}</p>
                </div>
            @enderror
            @error('archivo')
                <div class="alert alert-danger mt-3">
                    <p class="m-0">{{ $message }}</p>
                </div>
            @enderror

            @if ($allRows)
                <h2>Datos Cargados</h2>

                <table class="table border border-1">
                    <thead>
                        <tr>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Cantidad de Asientos</th>
                            <th>Tarifa Base</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allRows as $row)
                            <tr
                                style="background-color: {{ $row['type'] == 0 ? '#a8e6cf' : ($row['type'] == 2 ? '#ff8a80' : ($row['type'] == 1 ? '#e4e6a8' : '')) }}">
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
    </div>
@endsection
