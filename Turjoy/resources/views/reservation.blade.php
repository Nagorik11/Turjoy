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
            height:80px;
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
                <img href="/" class="header-logo" src="{{ URL('images/turjoylogo.png') }}" width="100" height="100">
            </a>
        </div>

        <div style="display: flex; justify-content: center; align-items: center; height: 100px;">
            <label class="custom-label">Reservar Pasaje</label>
        </div>

        <form action="{{ route('reservation.store') }}" method="POST" style="margin: 20px auto 0; max-width:500px;">

            <div class="card-body">
            <div class="form-group">
                <label for="date">Fecha del viaje:</label>

                <script>
                    $(function() {
                        $("#date").datepicker({
                            format: "yyyy-mm-dd"
                        });
                        $("#date").on("changeDate", function() {
                            var selectedDate = $("#date").datepicker("getDate");

                            console.log(selectedDate);
                        });
                    });
                </script>

            <input type="date" id="date" name="date" class="form-control" min="{{date('Y-m-d')}}">
            @error('date')
                <div class="alert alert-danger mt-3" style="color: #ff8a80">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-group">

                <div class="form-group">
                    <label for="origin">Origen:</label>
                    <select id="origin" name="origin" class="selectpicker form-control" data-flag="true" data-width="500px">
                        @php
                            $uniqueOrigins = $routes->pluck('origin')->unique()->toArray();
                        @endphp
                        @foreach($uniqueOrigins as $origin)
                        <option value="{{ $origin }}">{{ $origin }}</option>
                        @endforeach
                        <script>
                            $(document).ready(function() {
                                $('#origin').on('change', function() {
                                    var selectedOrigin = $(this).val();
                                    console.log("Valor seleccionado en 'Origen': " + selectedOrigin);
                                });
                            });
                        </script>
                    </select>

            @error('origin')
                <div class="alert alert-danger mt-3" style="color: #ff8a80">
                    {{ $message }}
                </div>
            @enderror
            <label for="destiny">Destino:</label>
            <select name="destiny" id="destinoSelect" class="selectpicker form-control" data-flag="true" data-width="500px">
                        @php
                            $uniqueDestiny = $routes->pluck('destiny')->unique()->toArray();
                        @endphp
                        @foreach($uniqueDestiny as $destiny)
                        <option value="{{ $destiny }}">{{ $destiny }}</option>
                        @endforeach
                    </select>
            <!-- Opciones de destino se cargarán dinámicamente con JavaScript -->
            </select>
            @error('destiny')
                <div class="alert alert-danger mt-3" style="color: #ff8a80">
                    {{ $message }}
                </div>
            @enderror
            </div>
                <label for="seat_quantity">Cantidad de Asientos:</label>
                <input type="number" name="seat_quantity" class="number-input form-control" value="1" min="1" inputmode="numeric" onchange="validateInput(this)">
            </div>

            <script>
                function validateInput(input) {
                    const value = input.value;
                    if (value === "0" || value < 1) {
                        input.value = "1";
                    }
                }
            </script>
            @csrf
            <button id="reservarButton" type="submit" class="custom-button">Reservar</button>

            <script src="{{asset('js/app.js')}}"></script>

            <script>
                // Your existing script
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });

                // Function to show SweetAlert and return a Promise
                function showSwal() {
                    return new Promise((resolve) => {
                        swalWithBootstrapButtons.fire({
                            text: "El total de la reserva entre y (destiny para el día (fecha) es de (base_rate) ((seat_quantity) asientos), ¿Desea continuar?",
                            showCancelButton: true,
                            confirmButtonText: "Confirmar",
                            cancelButtonText: "Volver",
                            reverseButtons: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        }).then((result) => {
                            resolve(result.isConfirmed);
                        });
                    });
                }

                document.getElementById('reservarButton').addEventListener('click', async function (event) {
                    // Prevent the default form submission
                    event.preventDefault();

                    // Show SweetAlert and wait for user confirmation
                    const isConfirmed = await showSwal();

                    // If the user confirms, redirect to the postview route
                    if (isConfirmed) {
                        // Redirect to the postview route
                        swalWithBootstrapButtons.fire({
                            title: "Reserva confirmada!",
                            text: "Tu reserva ha sido confirmada",
                            icon: "success"
                        }).then(() => {
                        // Redirect to the postview route
                        window.location.href = '/postview';
    });
                    } else {
                        // User clicked "Volver" or closed the dialog
                        swalWithBootstrapButtons.fire({
                            title: "Reserva cancelada!",
                            text: "Tu reserva ha sido cancelada",
                            icon: "error"
                        });
                    }
                });
            </script>

        </form>
    </div>
</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
        $(document).ready(function() {
            $('#origin').on('change', function() {
                var selectedOrigin = $(this).val();
                var destinoSelect = $('#destinoSelect');

                // Limpia las opciones actuales del campo de destino
                destinoSelect.empty();

                // Itera sobre las rutas y agrega las opciones de destino correspondientes
                $.each(@json($routes), function(index, route) {
                    if (route.origin === selectedOrigin && route.origin !== route.destiny) {
                        destinoSelect.append($('<option>', {
                            value: route.destiny,
                            text: route.destiny
                        }));
                    }
                });

                // Actualiza el selector de destino
                destinoSelect.selectpicker('refresh');
            });

            // Inicializa el selector de destino al cargar la página
            $('#origin').trigger('change');
        });
    </script>
    <script>
    var seatQuantityInput = document.getElementById("seat_quantity");
    var seatQuantity = seatQuantityInput.value;
    </script>

<script>
    $(document).ready(function() {
        $('#fecha').on('input', function() {
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
</html>
