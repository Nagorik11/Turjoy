@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <p class="lead">Cargar rutas de viaje.</p>

        <form action="{{ route('cargar-archivo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="archivo">Selecciona un archivo XLS:</label>
                <input type="file" name="archivo" id="archivo" accept=".xlsx">
            </div>
            <button type="submit" class="btn btn-primary">Cargar archivo</button>
        </form>
            <div class="container">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Resto del contenido de la vista aquí -->
    </div>

        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">You're viewing the home page. Please login to view restricted data.</p>
        @endguest
    </div>
@endsection
