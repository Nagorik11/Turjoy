@extends('layouts.app-master')


@section('content')
    {{ count($validRows) }}
    {{ count($invalidRows) }}
    {{ count($duplicatedRows) }}
    
    @auth
    <div class="bg-light p-5 rounded">
        
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

<<<<<<< HEAD
        <form action="{{ route('loadFile') }}" method="POST" enctype="multipart/form-data">
=======
        <form action="{{ route('load-file') }}" method="POST" enctype="multipart/form-data">
>>>>>>> 81f025e720e23d3ef07d6e093f54eeb2078857b5
            @csrf
            <div class="form-group">
                <label for="archivo">Selecciona un archivo XLSX:</label>
                <input type="file" name="archivo" id="archivo" accept=".xlsx">
            </div>
            <button type="submit" class="btn btn-primary">Cargar archivo</button>
        </form>
    </div>

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

                @if (count($validRows) > 0)
                    <h3 class="text-2xl text-black font-semibold uppercase text-center">Listado de viajes agregados
                        correctamente
                    </h3>
                    <div class="relative overflow-x-auto sm:rounded-lg mb-2">
                        <table class="w-full mx-auto text-sm text-left text-blue-100 dark:text-gray-400">
                            <thead class="text-xs text-black uppercase bg-blue-600 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-bold">
                                        Origen
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-bold">
                                        Destino
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-bold">
                                        Cantidad de asientos
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-bold">
                                        Tarifa base
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($validRows as $validRow)
                                    <tr class="bg-green-400 border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium whitespace-nowrap dark:text-white">
                                            {{ $validRow['origen'] }}
                                        </th>
                                        <td class="px-6 py-4 font-medium">
                                            {{ $validRow['destino'] }}
                                        </td>
                                        <td class="px-6 py-4 font-medium">
                                            {{ $validRow['cantidad_de_asientos'] }}
                                        </td>
                                        <td class="px-6 py-4 font-medium">
                                            {{ $validRow['tarifa_base'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                @if (count($invalidRows))
                    <h3 class="text-2xl text-black font-semibold uppercase text-center">
                        Listado de viajes que presentaron errores
                    </h3>
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table class="w-1/2 mx-auto text-sm text-left text-gray-500 bg-green-600 dark:text-gray-400 mb-2">
                            <thead class="text-xs text-gray-700 uppercase bg-red-600 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-bold">
                                        Origen
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-bold">
                                        Destino
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-bold">
                                        Cantidad de asientos
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-bold">
                                        Tarifa base
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invalidRows as $invalidRow)
                                    <tr class="bg-red-400 border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium whitespace-nowrap dark:text-white">
                                            {{ $invalidRow['origen'] ? $invalidRow['origen'] : '---' }}
                                        </th>
                                        <td class="px-6 py-4 font-medium">
                                        {{ $invalidRow['destino'] ? $invalidRow['destino'] : '---' }}
                                        </td>
                                        <td class="px-6 py-4 font-medium">
                                        {{ $invalidRow['cantidad_de_asientos'] ? $invalidRow['cantidad_de_asientos'] : '---' }}
                                        </td>
                                        <td   td class="px-6 py-4 font-medium">
                                        {{ $invalidRow['tarifa_base'] ? $invalidRow['tarifa_base'] : '---' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

<<<<<<< HEAD
                @if (count($duplicatedRows))
                    <h3 class="text-2xl text-black font-semibold uppercase text-center">
                        Listado de viajes que se encuentran duplicados
                    </h3>
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table class="w-1/2 mx-auto text-sm text-left text-gray-500 dark:text-gray-400 mb-2">
                            <thead class="text-xs text-gray-700 uppercase bg-amber-600 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-bold">
                                        Origen
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-bold">
                                        Destino
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-bold">
                                        Cantidad de asientos
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-bold">
                                        Tarifa base
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($duplicatedRows as $duplicatedRow)
                                    <tr class="bg-yellow-400 border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                                            {{ $duplicatedRow['origen'] }}
                                        </th>
                                        <td class="px-6 py-4 text-white font-medium">
                                            {{ $duplicatedRow['destino'] }}
                                        </td>
                                        <td class="px-6 py-4 text-white font-medium">
                                            {{ $duplicatedRow['cantidad_de_asientos'] }}
                                        </td>
                                        <td class="px-6 py-4 text-white font-medium">
                                            {{ $duplicatedRow['tarifa_base'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @else
                <h3 class="text-2xl text-black font-semibold uppercase text-center">
                    NO SE HAN CARGADO UN ARCHIVO
                </h3>
            @endif
            </div>
    @endauth
@endsection

=======
        @guest
        <h1>Homepage</h1>
        <p class="lead"></p>
        @endguest
    </div>
@endsection
>>>>>>> 81f025e720e23d3ef07d6e093f54eeb2078857b5
