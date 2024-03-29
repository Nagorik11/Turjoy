@extends('layouts.auth-master')

@section('content')

<head>
    
    <style>
        .card {
            height: 800px !important;
            width: 800px !important;
            position: relative;
        }
        .custom-label {
            font-size: 48px;
            color: #0A74DA;
            text-align: center;
            font-weight: bold;
            font-family:Arial;
            margin-bottom:7px;
        }

        .header-logo {
            margin-top: -14px !important;
            margin-right: 630px !important;
        }

        input.form-control {
            margin-top:10px;
            width:300px !important;
        }

        .btn-primary {
            background-color:#0A74DA;
            width:200px;
        }

    </style>
</head>

<body>

    <div class="card mx-auto mb-5 mt-3" style="height: 810px; width: 800px;">
        <div class="card-header" style="background-color: #0A74DA;">
            <a class="header-container navbar-brand" href="/">
                <img href="/" class="header-logo" src="{{ URL('images/turjoylogo.png') }}" height="100" width="100">
            </a>
        </div>

        <div style="display: flex; justify-content: center; align-items: center; height: 100px;">
            <label class="custom-label">Iniciar Sesión</label>
        </div>

        <form method="post" action="{{ route('login.perform') }}" style="margin: 20px auto 0; max-width:500px;">
            <div class="card-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <div class="form-group form-floating mb-3">
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" autofocus
                        data-toggle="tooltip" data-placement="top" title="Ingrese su correo electrónico">
                         <label for="floatingName">Correo electrónico</label>
                </div>

                @include('layouts.partials.messages')

                <div class="form-group form-floating mb-3">
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Contraseña"
                    data-placement="top" title="Ingrese su contraseña">
                    <label for="floatingPassword">Contraseña</label>
                </div>

                <button class="btn btn-primary" type="submit" data-toggle="tooltip" data-placement="top" title="Haga clic para acceder">Acceder</button>            </div>
        </form>

        <footer style="padding:10px; text-align: center; position: absolute; bottom: 0; left: 0; right: 0;">
            Codecrafters &copy; <script>document.write(new Date().getFullYear())</script>
        </footer>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="//cdn.tutorialjinni.com/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/js/bootstrap-select-country.min.js"></script>
</body>
</html>
