<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

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
            border-radius: 3px;
            overflow: hidden;
            margin: auto;
            margin-top: 5rem;
        }
        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 15px; /* Adjust the margin-top value as needed */
        }

        .header-logo {
            margin-right: 10px;
        }

        .btn-primary {
            background-color: #0A74DA;
            display: block;
            margin: 0 auto;
            width: 200px;
        }

        .table th,
        .table td {
            text-align: left;
        }

        .tr-custom{
            background-color:#EAEAEA;
            padding: 15px;
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

        <div class="card-body">
            <h1 class="custom-label">Detalles del Voucher</h1>
            <hr>
            <table class="table table-bordered">
                <tr>
                    <th>Código de la reserva</th>
                    <td>{{ $voucher->code }}</td>
                </tr>
                <tr class="tr-custom">
                    <th>Origen</th>
                    <td>{{ $voucher->origin }}</td>
                </tr>
                <tr>
                    <th>Destino</th>
                    <td>{{ $voucher->destiny }}</td>
                </tr>
                <tr class="tr-custom">
                    <th>Fecha</th>
                    <td>{{ date('d/m/Y', strtotime($voucher->date)) }}</td>
                </tr>
                <tr>
                    <th>Cantidad de asientos</th>
                    <td>{{ $voucher->seat_quantity }}</td>
                </tr>
                <tr class="tr-custom">
                    <th>Tarifa base</th>
                    <td>{{"$". number_format($voucher->base_rate, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Método de pago</th>
                    <td>{{$voucher->payment }}</td>
                </tr>
                <tr class="tr-custom">
                    <th>Total</th>
                    <td>{{"$". number_format($voucher->base_rate * $voucher->seat_quantity, 0, ',', '.') }}</td>
                </tr>
            </table>
            <button class="btn btn-primary" onclick="imprimir()">Imprimir Voucher</button>
        </div>
    </div>

    <script>
        function imprimir() {
            window.print();
        }
    </script>

    <!-- Add any necessary script tags or additional dependencies here -->

</body>

</html>
