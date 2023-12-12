@extends('layouts.app-master')

@section('content')

    <div class="pt-5 rounded">

        <h3 class="my-6 font-bold text-3x1 uppercase">Reporte de reservas</h3>
        <form action="{{ route('report.reservations') }}" method="GET">
            @csrf
            <div class="d-flex flex gap-4 my-4">
                <div class="input-group" style="width: auto !important">
                    <span class="input-group-text" id="basic-addon1">Fecha inicial</span>
                    <input type="date" class="border border-2 rounded-end" name="min_date" id="min_date" class=""
                        data-toggle="tooltip" data-placement="top" title="Las reservas tendran una fecha superior a esta">
                </div>
                <div class="input-group" style="width: auto !important">
                    <span class="input-group-text" id="basic-addon1">Fecha término</span>
                    <input type="date" class="border border-2 rounded-end" name="max_date" id="max_date" class=""
                        data-toggle="tooltip" data-placement="top" title="Las reservas tendran una fecha inferior a esta">
                </div>
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                    title="Haz clic para buscar las reservas entre las fechas">Buscar</button>
            </div>
        </form>
        @error('error')
            <p class="relative alert rounded-lg" style="background-color: #ff8a80; color:black;">
                {{ $message }}
            </p>
        @enderror
        @if ($vouchers->count() > 0)
            @isset($vouchers)
                <table class="table border border-1" style="font-size:0.9rem">
                    <thead>
                        <tr>
                            <th class="border border-1">Codigo de reserva</th>
                            <th class="border border-1">Fecha de reserva</th>
                            <th class="border border-1">Dia de la reserva</th>
                            <th class="border border-1">Ciudad de origen</th>
                            <th class="border border-1">Ciudad de destino</th>
                            <th class="border border-1">Cantidad de asientos</th>
                            <th class="border border-1">Valor total</th>
                            <th class="border border-1">Metodo de pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vouchers as $index => $row)
                            <tr class="border border-1" style="{{ $index % 2 == 0 ? 'background-color: #EAEAEA;' : '' }}">
                                <td class="border border-1">{{ $row['code'] }}</td>
                                <td class="border border-1">{{ \Carbon\Carbon::parse($row['date'])->format('d/m/Y') }}</td>
                                <td class="border border-1">{{ \Carbon\Carbon::parse($row['created_at'])->format('d/m/Y') }}
                                </td>
                                <td class="border border-1">{{ $row['origin'] }}</td>
                                <td class="border border-1">{{ $row['destiny'] }}</td>
                                <td class="border border-1">{{ $row['seat_quantity'] }}</td>
                                <td class="border border-1">{{  "$" . number_format(($row['base_rate'] * $row['seat_quantity']), 0, ',', '.')}}</td>
                                <td class="border border-1">{{ $row['payment'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endisset
        @else
            <p class="relative alert rounded-lg" style="background-color: #ff8a80; color:black;">
                No hay reservas en el sistema
            </p>
        @endif
    </div>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>
        document.getElementById('min_date').onchange = function() {
            document.getElementById('max_date').min = this.value;
        };
        document.getElementById('max_date').onchange = function() {
            document.getElementById('min_date').max = this.value;
        };
    </script>

@endsection
