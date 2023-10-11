@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('login.perform') }}" class="container w-25">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />


        <h1 class="h3 mb-3 fw-normal">Login</h1>

        @include('layouts.partials.messages')


        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="email" autofocus>
            <label for="floatingName">Correo electrónico</label>

        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password">
            <label for="floatingPassword">Contraseña</label>

        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>

        @include('auth.partials.copy')
    </form>
@endsection
