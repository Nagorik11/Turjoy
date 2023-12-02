<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/css/bootstrap-select-country.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
        .card {
            height: 800px;
            width: 800px;
            position: relative;
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
            color: #000;
        }

        .custom-table {
            border: 2px solid #2ECC71;
            border-collapse: collapse;
            width: 80%;
            margin: 100px auto 0;
        }

        .custom-table th, .custom-table td {
            padding: 15px;
        }

        .bootstrap-select .bs-caret {
            display: none;
        }

        .number-input {
            width: 500px;
            text-align: left;
        }

        .custom-label {
            font-size: 48px;
            color: #0A74DA;
        }

        .header-container {
            display: flex;
            align-items: center;
            height: 80px;
        }

        .header-logo {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="card mx-auto mb-5 mt-4">
        <div class="card-header" style="background-color: #0A74DA;">
            <a class="header-container navbar-brand" href="/">
                <img class="header-logo" src="{{ URL('images/turjoylogo.png') }}" width="100" height="100">
            </a>
        </div>

        <div style="display: flex; justify-content: center; align-items: center; height: 100px;">
            <label class="custom-label">Reservar Pasaje</label>
        </div>

        <form style="margin: 20px auto 0; max-width:500px;">
            <div class="form-group">
                <label for="fecha">Fecha del viaje:</label>
                <input type="date" id="datepicker" class="form-control" min="" placeholder="Select a date">
            </div>
            
            <div class="form-group">
                <label for="origen">Origen:</label>
                <div>
                    <select name="origin" class="selectpicker form-control" data-flag="true" data-width="500px">
                    @foreach($routes as $route)       
                        <option value="{{ $route->origin }}">{{ $route->origin }}</option>
                        
                        @endforeach

                </select>
                <label for="destination">Destino:</label>
                <div>
                    <select name="destination" class="selectpicker form-control" data-flag="true" data-width="500px">
                    @foreach($route as $rout)       
                   

                        <option value="{{ $rout->destiny }}">{{ $rout->destiny }}</option>
                        
                        @endforeach
                   
                    

                </select>
                </div>
            </div>
            <div class="form-group">
                <label for="cantidadAsientos">Cantidad de Asientos:</label>
                <div>
                    <input type="number" id="seatCount" class="number-input form-control" value="1" min="1">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="custom-button">Reservar</button>
            </div>
        </form>
    </div>

    <script>
        function validateInput(input) {
            const value = input.value;
            if (value === "0" || value < 1) {
                input.value = "1";
            }
        }

        $(document).ready(function() {
            $('#datepicker').on('input', function() {
                var input = $(this).val();
                input = input.replace(/\D/g, '');
                if (input.length > 2) {
                    if (input.length > 4) {
                        input = input.slice(0, 2) + '/' + input.slice(2, 4) + '/' + input.slice(4, 8);
                    } else {
                        input = input.slice(0, 2) + '/' + input.slice(2, 4);
                    }
                }
                $(this).val(input);
            });
        });
    </script>

    <script src="//cdn.tutorialjinni.com/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/js/bootstrap-select-country.min.js"></script>
</body>
</html>
