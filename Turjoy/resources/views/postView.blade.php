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
    <div class="card mx-auto mb-5 mt-4">
        <div class="card-header" style="background-color: #0A74DA;">

            <a class="header-container navbar-brand" href="/">
                <img href="/" class="header-logo" src="{{ URL('images/turjoylogo.png') }}" width="100" height="100">
            </a>
            </div>
            

</head>
<body>
    <div>
        <h1>Detalles del Voucher</h1>
        <table>
            <tr>
                <th>Código de la reserva</th>
                <td>{{ $voucher->code }}</td>
            </tr>
            <tr>
                <th>Origen</th>
                <td>{{ $voucher->origin }}</td>
            </tr>
            <tr>
                <th>Destino</th>
                <td>{{ $voucher->destiny }}</td>
            </tr>
            <tr>
                <th>Fecha</th>
                <td>{{ $voucher->date }}</td>
            </tr>
            <tr>
                <th>Cantidad de asientos</th>
                <td>{{ $voucher->seat_quantity }}</td>
            </tr>
            <tr>
                <th>Tarifa base</th>
                <td>{{ $voucher->base_rate }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <td>{{ $voucher->base_rate*$voucher->seat_quantity }}</td>
            </tr>
        </table>
        <button onclick="imprimir()">Imprimir Voucher</button>
    </div>

    <script>
        function imprimir() {
            window.print();
        }
    </script>
</body>
</html>