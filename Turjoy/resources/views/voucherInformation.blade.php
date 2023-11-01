@extends('layouts.auth-master')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        @if(isset($voucher))
            <h2>Voucher Information</h2>
            <p>Code: {{ $voucher->id }}</p>
            <p>Origin: {{ $voucher->Route_id }}</p>
            <p>Destination: {{ $voucher->seats }}</p>
            <!-- Agrega aquí otros detalles del voucher -->
        @else
            <h2>Error</h2>
            <p>{{ $error }}</p>
        @endif
    </div>
</body>
</html>
