<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/css/bootstrap-select-country.min.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
        .card {
            height: 800px;
            width: 800px;
            position: relative;
        }

        .custom-button {
            background-color: #2ECC71;
            color: #000;
            width: 100px;
        }

        .return-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
            color: #000;
        }

        .custom-table {
            border: 2px solid #2ECC71;
            border-collapse: collapse;
            width: 80%;
            margin: 100px auto 0;
        }

        .custom-table th, .custom-table td {
            padding: 15px;
        }

        .bootstrap-select .bs-caret {
            display: none;
        }

        .number-input {
            width: 500px;
            text-align: left;
        }

        .custom-label {
            font-size: 48px;
            color: #0A74DA;
        }

        .header-container {
            display: flex;
            align-items: center;
            height:80px;
        }

        .header-logo {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="card mx-auto mb-5 mt-4">
        <div class="card-header" style="background-color: #0A74DA;">

            <a class="header-container navbar-brand" href="/">
                <img href="/" class="header-logo" src="{{ URL('images/turjoylogo.png') }}" width="100" height="100">
            </a>
            </div>
                <h1 class="text.center">Buscar Reservas</h1>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4  d-flex align-items-center offset-md-2 justify-content-sm-start">
                        <p class="fs-4 m-0">Ingrese el codigo de la reserva:</p>
                    </div>
                    <div class="col-md-4 d-flex align-items-center ">
                        <form action="/voucher-search/search_code" method="GET">
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
                        <p class="m-0" style="color: #212529">{{$message}}</p>
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

</html>