<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

   <style>
        .custom-label {
            font-size: 48px;
            color: #0A74DA;
            text-align: center;
            font-weight: bold;
        }

        .card {
            height: 800px;
            width: 800px;
            position: relative;
        }

        .tr-custom{
            background-color:#EAEAEA;
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
        <h1 class="custom-label">Buscar Reservas</h1>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mx-auto d-flex align-items-center ">
                    <form action="/voucher-search" method="GET">
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

</body>

</html>
