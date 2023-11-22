<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/css/bootstrap-select-country.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

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
            
           
            
            <!-- Origin Select -->
            <div class="form-group">
                <label for="originSelect">Origen:</label>
                <div>
                    <select name="originSelect" class="select2 form-control" style="width: 100%;">
                        @foreach ($routes as $route)
                            <option value="{{ $route->origin }}">{{ $route->origin }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <!-- Destination Select -->
            <div class="form-group">
                <label for="destinationSelect">Destino:</label>
                <div>
                    <select name="destinationSelect" class="select2 form-control" style="width: 100%;">
                    
                            <option value="{destinationSelect}}</option>
                                     </select>
                </div>
            </div>
            
            <!-- Cantidad de Asientos Input -->
            <div class="form-group">
                <label for="cantidadAsientos">Cantidad de Asientos:</label>
                <div>
                    <input type="number" id="seatCount" class="number-input form-control" value="1" min="1">
                </div>
            </div>
            
            <!-- Reservar Button -->
            <div class="form-group">
                <button type="submit" class="custom-button">Reservar</button>
            </div>
        </form>
    </div>

    <!-- JavaScript for Dynamic Destination Options -->
    <script>
        $(document).ready(function() {
            $('#originSelect').on('change', function() {
                var selectedOrigin = $(this).val();
                var $destinationSelect = $('#destinationSelect');
                
                // Clear the current "Destino" options.
                $destinationSelect.empty();
                
                // Populate the "Destino" options dynamically based on the selected "Origen".
                @foreach ($routes as $route)
                    if ("{{ $route->origin }}" === selectedOrigin) {
                        $destinationSelect.append('<option value="{{ $route->destination }}">{{ $route->destination }}</option>');
                    }
                @endforeach
    
                // Refresh the Select2 plugin to reflect the changes.
                $destinationSelect.select2();
            });
        });
    </script>
    
    <!-- Initialize Select2 for Select Elements -->
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    <!-- External JavaScript Libraries -->
    <script src="//cdn.tutorialjinni.com/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/js/bootstrap-select-country.min.js"></script>
</body>
</html>