@extends('')

@section('content')

    <body>
        <div class="card m-5 mt-4">
            <div class="card-header" style="background-color: lightblue;">
                <h1 class="">Voucher de reserva</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4  d-flex align-items-center offset-md-2 justify-content-sm-start">
                @isset($voucher)
                    <div class="row card mx-2">
                        <table class="table p-5 m-0">
                            <tbody>
                                <tr>
                                    <th class="p-3" scope="row">Codigo de la reserva</th>
                                    <td>{{ $voucher->id }}</td>
                                </tr>
                                <tr>

                                    <th class="p-3" scope="row">Origen</th>
                                    <td>{{ $voucher->origin }}</td>
                                </tr>
                                <tr>
                                    <th class="p-3" scope="row">Destino</th>
                                    <td>{{ $voucher->destiny }}</td>
                                </tr>
                                <tr>
                                    <th class="p-3" scope="row">Dia de la reserva</th>
                                    <td>{{$voucher->date}}</td>
                                </tr>
                                <tr>
                                    <th class="p-3" scope="row">Cantidad de asientos</th>
                                    <td>{{ $voucher->seat_quantity }}</td>
                                </tr>
                                <tr>
                                    <th class="p-3" scope="row">Fecha de compra</th>
                                    <td>{{$voucher->created_at}}</td>
                                </tr>
                                <tr>
                                    <th class="p-3" scope="row">Costo total</th>
                                    <td>{{ $cost }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endisset
            </div>
    </body>
@endsection

</html>