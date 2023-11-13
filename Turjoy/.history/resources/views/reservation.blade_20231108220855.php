<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/css/bootstrap-select-country.min.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
        /* Your styles remain unchanged */
    </style>
</head>

<body>
    <div class="card mx-auto mb-5 mt-4">
        <div class="card-header" style="background-color: #0A74DA;">
            <a class="header-container navbar-brand" href="/">
                <img href="/" class="header-logo" src="{{ URL('images/turjoylogo.png') }}" width="100" height="100">
            </a>
        </div>

        <div style="display: flex; justify-content: center; align-items: center; height: 100px;">
            <label class="custom-label">Reservar Pasaje</label>
        </div>

        <div class="card-body">
            <form action="{{ route('reservation.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="fecha">Fecha del viaje:</label>
                    <input type="date" id="datepicker" class="form-control" min="today">
                </div>

                <div class="form-group">
                    <label for="origen">Origen:</label>
                    <select name="origin" class="selectpicker form-control" data-flag="true" data-width="500px">
                        @foreach($routes as $route)
                        <option value="{{ $route->origin }}">{{ $route->origin }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="destiny">Destino:</label>
                    <select name="destiny" class="selectpicker form-control" data-flag="true" data-width="500px">
                        @foreach($routes as $route)
                        @if($route->destiny !== $route->origin)
                        <option value="{{ $route->destiny }}">{{ $route->destiny }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="cantidadAsientos">Cantidad de Asientos:</label>
                    <input type="number" id="seatCount" class="number-input form-control" value="1" min="1">
                </div>

                <div class="form-group">
                    <button type="submit" class="custom-button">Reservar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("datepicker").datepicker({
                dateFormat: "yy-mm-dd"
            });

            var today = new Date().toISOString().split('T')[0];
            document.getElementById("datepicker").min = today;
        });

        function validateInput(input) {
            const value = input.value;
            if (value === "0" || value < 1) {
                input.value = "1";
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/js/bootstrap-select-country.min.js"></script>
</body>

</html>
