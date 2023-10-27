@extends('layouts.app-master')

@section('content')

    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <p class="lead">Cargar rutas de viaje.</p>

        {{-- @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif --}}

        @error('archivo')
            <div class="alert alert-danger mt-3">
                <p class="m-0">{{ $message }}</p>
            </div>
        @enderror

        <form action="{{ route('travel.check') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="archivo">Selecciona un archivo XLSX:</label>
                <input type="file" name="archivo" id="archivo" accept=".xlsx">
            </div>
            <button type="submit" class="btn btn-primary">Cargar archivo</button>
        </form>

        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead"></p>
        @endguest
    </div>
@endsection

