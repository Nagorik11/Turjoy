
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Reserva</title>


    <!-- Bootstrap core CSS -->
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
</head>
<body>
    <div class="card m-5 mt-4">
        <div class="card-header" style="background-color: lightblue;">
            <h1 class="">Buscar Reservas</h1>
            
        </div>
        <form method="post" action="{{ route('voucher.search') }}" class="container mt-4">
        @csrf

    <div class="form-group form-floating mb-3">
        <div class="input-group">
            <input type="text" class="form-control" name="code" value="{{ old('code') }}" placeholder="Código del Voucher" autofocus>
            <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
        </div>
        @if(isset($voucher))
    <!-- Mostrar detalles del voucher aquí -->
    @elseif(isset($error))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
@endif
       
    </div>
</form>



        @include('layouts.partials.messages')

   


                        <a href="{{ route('home.index') }}" class="btn btn-outline-primary">Regresar</a>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row card mx-2">
                <table class="table p-5 m-0">
                    <tbody>
                        <tr>
                            crear vista de la tabla si el resultado del voucher es correcto
                            crear errores para cuando el voucher no exista
                        </tr>
                        <tr>

</body>
</html>

