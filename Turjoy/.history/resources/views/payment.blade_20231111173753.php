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

<body>
    <h1>Seleccionar método de pago</h1>
    <form action="#" method="POST">
        @csrf
        <div class="form-group">
            <label for="payment_method">Método:</label>
            <select name="payment_method" id="payment_method" class="form-control">
                <option value="credit_card">Tarjeta de Crédito</option>
                <option value="debit_card">Tarjeta de Débito</option>
                <option value="paypal">PayPal</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Continuar</button>
    </form>
</body>
</html>
