<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}">
<<<<<<< HEAD
    <style>
=======
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

   <style>
        .custom-label {
            font-size: 48px;
            color: #0A74DA;
            text-align: center;
            font-weight: bold;
        }

>>>>>>> 8ebd5c0b452da6b7e3c4d8fd28806598daeefb42
        .card {
            height: 800px;
            width: 800px;
            position: relative;
        }

<<<<<<< HEAD
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

        .custom-table th,
        .custom-table td {
=======
        .tr-custom{
            background-color:#EAEAEA;
>>>>>>> 8ebd5c0b452da6b7e3c4d8fd28806598daeefb42
            padding: 15px;
        }

        .header-container {
            display: flex;
            align-items: center;
            height: 80px;
        }

        .header-logo {
            margin-right: 10px;
        }

        .btn-primary{
            background-color:#0A74DA;
            display:block;
            margin: 0 auto;
            width:200px;
        }
        .col-md-4 {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .input-group input.form-control {
            margin-bottom:10px;
            width: 300px;
        }

    </style>
</head>

<body>
    <div class="card mx-auto mb-5 mt-4">
        <div class="card-header" style="background-color: #0A74DA;">
            <a class="header-container navbar-brand" href="/">
                <img href="/" class="header-logo" src="{{ URL('images/turjoylogo.png') }}" width="100"
                    height="100">
            </a>
        </div>
<<<<<<< HEAD
        <h1 class="text-center">Buscar Reservas</h1>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4  d-flex align-items-center offset-md-2 justify-content-sm-start">
                    <p class="fs-4 m-0">Ingrese el codigo de la reserva:</p>
                </div>
                <div class="col-md-4 d-flex align-items-center ">
                    <form action="/voucher-search" method="GET">
                        <div class="input-group d-flex justify-content-center">
                            <input type="text" name="search_code" class="form-control"
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
                    <p class="m-0" style="color: #212529">{{ $message }}</p>
                </div>
            @enderror
            @isset($voucher)
                <div class="row card mx-2">
                    <table class="table p-5 m-0">
                        <tbody>
                            <tr>
                                <th class="p-3" scope="row">Codigo de la reserva</th>
                                <td>{{ $voucher->code }}</td>
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
                                <td>{{ $voucher->date }}</td>
                            </tr>
                            <tr>
                                <th class="p-3" scope="row">Cantidad de asientos</th>
                                <td>{{ $voucher->seat_quantity }}</td>
                            </tr>
                            <tr>
                                <th class="p-3" scope="row">Fecha de compra</th>
                                <td>{{ $voucher->created_at }}</td>
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
=======
        <h1 class="custom-label">Buscar Reservas</h1>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mx-auto d-flex align-items-center ">
                    <form action="/voucher-search/search_code" method="GET">
                        @csrf
                        <div class="input-group">
                                <input type="text" name="search_code" class="form-control" placeholder="Codigo de reserva">
                            <div>
                                <button class="btn btn-primary" type="submit">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <hr>

            @error('search_code')
            <div class="alert alert-danger  mt-3" style="background-color:  #ff8a80">
                <p class="m-0" style="color: #212529">{{$message}}</p>
            </div>
            @enderror
            @isset($voucher)

            <div class="row card mx-1 mt-5" style="width: 775px; height:290px;">
                <table>
                    <tbody>
                        <tr>
                            <th class="p-3" scope="row">Código de la reserva</th>
                            <td>{{ $voucher->code }}</td>
                        </tr>
                        <tr class='tr-custom'>
                            <th class="p-3" scope="row">Ciudad de Origen</th>
                            <td>{{ $voucher->origin }}</td>
                        </tr>
                        <tr>
                            <th class="p-3" scope="row">Ciudad de Destino</th>
                            <td>{{ $voucher->destiny }}</td>
                        </tr>
                        <tr class='tr-custom'>
                            <th class="p-3" scope="row">Dia de la Reserva</th>
                            <td>{{ \Carbon\Carbon::parse($voucher->date)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th class="p-3" scope="row">Cantidad de Asientos</th>
                            <td>{{ $voucher->seat_quantity }}</td>
                        </tr>
                        <tr class='tr-custom'>
                            <th class="p-3" scope="row">Fecha de la compra</th>
                            <td>{{\Carbon\Carbon::parse($voucher->created_at)->format('d/m/Y')}}</td>
                        </tr>
                        <tr>
                            <th class="p-3" scope="row">Total</th>
                            <td>{{"$". number_format($cost, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endisset
        </div>

        <footer style="padding: 2px; text-align: center; position: relative; bottom: 0; left: 0; right: 0; font-size:16px;">
            Codecrafters &copy; <script>document.write(new Date().getFullYear())</script>
        </footer>
    </div>

>>>>>>> 8ebd5c0b452da6b7e3c4d8fd28806598daeefb42
</body>

</html>
