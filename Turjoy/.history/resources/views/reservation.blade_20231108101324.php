<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Incluye tus bibliotecas CSS y JavaScript aquí -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
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
                <input type="date" id="datepicker" class="form-control" min="" placeholder="Selecciona una fecha">
            </div>
            
            <div class="form-group">
                <label for="originSelect">Origen:</label>
                <div>
                    <select id="originSelect" class="select2 form-control" style="width: 100%;">
                        @foreach ($routes as $route)
                            <option value="{{ $route->origin }}">{{ $route->origin }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="destinationSelect">Destino:</label>
                <div>
                    <select id="destinationSelect" class="select2 form-control" style="width: 100%;">
                        <!-- Las opciones se actualizarán dinámicamente mediante JavaScript -->
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
        $(document).ready(function() {
            $('#datepicker').on('input', function() {
                // Tu código de manejo de entrada de fecha aquí
            });

            // Define un objeto JavaScript que asigna los orígenes a sus destinos disponibles.
            var destinationMap = {
                @foreach ($routes as $route)
                    "{{ $route->origin }}": "{{ $route->destiny }}",
                @endforeach
            };

            // Get the "Origen" and "Destino" select elements.
            var $originSelect = $('#originSelect');
            var $destinationSelect = $('#destinationSelect');

            // When the "Origen" select field changes, update the "Destino" options.
            $originSelect.on('change', function() {
                var selectedOrigin = $(this).val();
                var selectedDestination = destinationMap[selectedOrigin];

                // Clear the current "Destino" options and add the new one.
                $destinationSelect.empty();
                $destinationSelect.append('<option value="' + selectedDestination + '">' + selectedDestination + '</option>');

                // Refresh the Select2 plugin to reflect the changes.
                $destinationSelect.trigger('change');
            });

            // Inicializa el plugin Select2
            $('.select2').select2();
        });
    </script>
</body>
</html>
