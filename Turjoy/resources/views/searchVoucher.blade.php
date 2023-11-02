<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turjoy</title>
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <style>
        .card {
            height: 800px;
            width: 1280px;
            position: relative; /* Agregamos posicionamiento relativo a la tarjeta */
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
            color:#000;
        }

        .custom-table {
            border: 2px solid #2ECC71;
            border-collapse: collapse;
            width: 80%; /* Hacemos que la tabla ocupe todo el ancho disponible */
            margin: 100px auto 0; /* Centramos la tabla horizontalmente */

        }
        .custom-table th,.custom-table td {
            padding: 15px; /* Aumentamos el relleno para hacer la tabla más grande */
        }
    </style>
</head>
<body>
    <div class="card mx-auto mb-4 mt-4">
        <div class="card-header" style="background-color: #2ECC71;">
            <h1 class="text-center">Buscar Reservas</h1>
        </div>
        <form method="post" action="{{ route('voucher.search') }}" class="container mt-4">
            @csrf
            <div class="d-flex align-items-center justify-content-center">
                <h5 style="margin-right: 50px;">Ingresa código de reserva:</h5>
                <div class="input-group" style="width: 300px;">
                    <input type="text" class="form-control" placeholder="Código de reserva" value="{{ old('code') }}" name="code">
                    <div class="input-group-append">
                        <button class="btn custom-button" type="submit">Buscar</button>
                    </div>
                </div>
            </div>
        </form>

        @if(isset($voucher))
        @elseif(isset($error))
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endif

        @include('layouts.partials.messages')

        <div class="return-button">
            <a href="{{ route('home.index') }}" class="btn custom-button">Regresar</a>
        </div>
        <hr>
        <table class="table custom-table">
            <tbody>
              <tr>
                <th scope="col">Codigo de reserva</th>
                <td scope="col">1</td>
              </tr>

              <tr>
                <th scope="row">Origen</th>
                <td>2</td>
              </tr>
              <tr>
                <th scope="row">Destino</th>
                <td>3</td>
              </tr>
              <tr>
                <th scope="row">Cantidad de asientos</th>
                <td>4</td>
              </tr>
              <tr>
                <th scope="row">Costo total</th>
                <td>5</td>
              </tr>
            </tbody>
          </table>
    </div>
</body>
</html>
