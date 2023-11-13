<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap core CSS -->
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
</head>
<body>
    <div class="card m-5 mt-4">
        <div class="card-header" style="background-color: lightblue;">
            
       
</head>
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
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>
