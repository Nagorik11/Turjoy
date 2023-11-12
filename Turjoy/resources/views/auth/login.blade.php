@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('login.perform') }}" class="container w-25 mt-5">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <h1 class="h3 fw-normal">Iniciar Sesión</h1>



        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="email" autofocus>
            <label for="floatingName">Correo electrónico</label>

        </div>

        @include('layouts.partials.messages')

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password">
            <label for="floatingPassword">Contraseña</label>

        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Acceder</button>

    </form>

    <style>
        footer{
            padding:100px;
            text-align:center;
            position:absolute;
            bottom:0;
            left:0;
            right:0;
        }
    </style>

    <footer>
        Codecrafters &copy; <script>document.write(new Date().getFullYear())</script>
    </footer>

@endsection