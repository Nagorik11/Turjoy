@extends('layouts.app-master')

@section('content')

    <body>
        <div class="card m-5 mt-4">
            <div class="card-header" style="background-color: lightblue;">
                <h1 class="">Buscar Reservas</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4  d-flex align-items-center offset-md-2 justify-content-sm-start">
                        <p class="fs-4 m-0">Ingrese el codigo de la reserva:</p>
                    </div>
                    <div class="col-md-4 d-flex align-items-center ">
                        <form action="/voucher-search" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name= "search_code" class="form-control"
                                    placeholder="Codigo de reserva" aria-label="Codigo de reserva"
                                    aria-describedby="button-addon2">
                                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr />
                @error('search_code')
                    <div class="alert alert-danger  mt-3" style="color:  #ff8a80">
                        <p class="m-0" style="color: #212529">ERROR</p>
                    </div>
                @enderror
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
                                    <td>{{ $route->origin }}</td>
                                </tr>
                                <tr>
                                    <th class="p-3" scope="row">Destino</t>
                                    <td>{{ $route->destiny }}</td>
                                </tr>
                                <tr>
                                    <th class="p-3" scope="row">Cantidad de asientos</th>
                                    <td>{{ $voucher->seats }}</td>
                                </tr>
                                <tr>
                                    <th class="p-3" scope="row">Costo total</th>
                                    <td>{{ $voucher->total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endisset
            </div>
    </body>
@endsection

</html>