@extends('layouts.app-master')

@section('content')
    <style>
        #custom-button {
            border-width: 1px;
        }

        #file-input {
            display: none;
        }

        #file-input-container {
            margin-bottom: 10px;
        }

        .card {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>

    @auth
        <div class="card">
            <h1>Cargar rutas</h1>
            <hr>


            <form action="{{ route('travel.check') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="file-input-container">
                    <input type="file" name="archivo" id="file-input" accept=".xlsx" hidden="hidden">
                    <button type="button" id="custom-button" data-toggle="tooltip"
                        title="Solo archivos .xlsx con peso menor a 5MB">Escoge un archivo</button>
                    <span id="custom-text">No has seleccionado ningún archivo</span>
                </div>
                <button type="submit" class="btn btn-primary">Cargar archivo</button>
            </form>
            @error('archivo')
                <div class="alert alert-danger mt-3">
                    <p class="m-0">{{ $message }}</p>
                </div>
            @enderror
        </div>
    @endauth


    <script>
        const fileInputBtn = document.getElementById("file-input");
        const customTxt = document.getElementById("custom-text");
        const customBtn = document.getElementById("custom-button");
        customBtn.addEventListener("click", function() {
            fileInputBtn.click();
        });

        fileInputBtn.addEventListener("change", function() {
            if (fileInputBtn.files.length > 0) {
                const fileName = fileInputBtn.files[0].name;
                customTxt.innerHTML = fileName;
            } else {
                customTxt.innerHTML = "No has seleccionado ningún archivo";
            }
        });
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    @guest

        <div class=" mt-3 alert" style="background-color: #ff8a80; color:black;">
            <p>No tienes acceso a este apartado</p>
        </div>

    @endguest
@endsection
