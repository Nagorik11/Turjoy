<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link rel="stylesheet"
        href="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/css/bootstrap-select-country.min.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .card {
            height: 800px;
            width: 800px;
            position: relative;
        }

        .bootstrap-select .bs-caret {
            display: none;
        }

        .number-input {
            width: 480px;
            text-align: left;
        }

        .btn-primary {
            background-color: #0A74DA;
            display: block;
            margin: 0 auto;
            margin-top: 100px;
            width: 200px;
        }

        .custom-label {
            margin-top: 12px;
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

        .form-control {
            margin-bottom: 10px !important;
        }

        .swal-btn-confirm {
            margin-left: 25px;
        }
    </style>
</head>

<body>
    <div class="card mx-auto mb-5 mt-4">
        <div class="card-header" style="background-color: #0A74DA;">

            <a class="header-container navbar-brand" href="/">
                <img href="/" class="header-logo" src="{{ URL('images/turjoylogo.png') }}" width="100"
                    height="100" data-toggle="tooltip" data-placement="top" title="Haz clic para volver al inicio">
            </a>
        </div>
        @if ($routes->count() == 0)
            <div class="m-3 alert d-flex justify-content-center align-items-center"
                style="background-color: #ff8a80; color:black; font-size:20px">No hay pasajes disponibles en este momento</div>
        @else
            <div style="display: flex; justify-content: center; align-items: center; height: 100px;">
                <label class="custom-label">Reservar Pasaje</label>
            </div>

            <form action="{{ route('reservation.store') }}" method="POST"
                style="margin: 20px auto 0; max-width:500px;">

                <div class="card-body">
                    <div class="form-group">
                    <label for="date" data-toggle="tooltip" data-placement="top" title="Seleccione la fecha del viaje">Fecha del
                    viaje:</label>

                        <script>
                            $(function() {
                                $("#date").datepicker({
                                    format: "dd-mm-yyyy"
                                });
                                $("#date").on("changeDate", function() {
                                    var selectedDate = $("#date").datepicker("getDate");

                                    console.log(selectedDate);
                                });
                            });
                        </script>

                        <input type="date" id="date" name="date" class="form-control"
                            min="{{ date('Y-m-d') }}">
                        @error('date')
                            <div class="mt-3 alert" style="background-color: #ff8a80; color:black;">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">

                            <div class="form-group">
                                <label for="origin">Origen:</label>
                                <select id="origin" name="origin" class="selectpicker form-control" data-flag="true"
                                    title="Selecciona la ciudad de origen" data-width="margin: 20px auto 0; max-width:480px;">
                                    @php
                                        $uniqueOrigins = $routes
                                            ->pluck('origin')
                                            ->unique()
                                            ->toArray();
                                    @endphp
                                    @foreach ($uniqueOrigins as $origin)
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
                                    <div class="mt-3 alert" style="background-color: #ff8a80; color:black;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="destiny">Destino:</label>
                                <select name="destiny" id="destinoSelect" class="selectpicker form-control"
                                    data-flag="true" title="Selecciona la ciudad de destino" data-width=480px;">
                                    @php
                                        $uniqueDestiny = $routes
                                            ->pluck('destiny')
                                            ->unique()
                                            ->toArray();
                                        $base_rate = $routes->pluck('base_rate')->toArray();
                                    @endphp

                                    @foreach ($uniqueDestiny as $destiny)
                                        <option value="{{ $destiny }}">{{ $destiny }}</option>
                                        return $destiny
                                        dd(base_rate);
                                    @endforeach
                                </select>
                                <!-- Opciones de destino se cargarán dinámicamente con JavaScript -->
                                </select>
                                @error('destiny')
                                    <div class=" mt-3 alert" style="background-color: #ff8a80; color:black;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label for="seat_quantity">Cantidad de Asientos:</label>
                            <input id="seat_quantity"type="number" name="seat_quantity"
                                class="number-input form-control" value="1" min="1" max="getMaxSeats(this)"
                                inputmode="numeric" onchange="validateInput(this)">
                            @error('seat_quantity')
                                <div class=" mt-3 alert" style="background-color: #ff8a80; color:black;">
                                    {{ $message }}
                                </div>
                            @enderror
                            @if (session('message'))
                                <div class="mt-3 alert" style="background-color: #ff8a80; color:black;">
                                    {{ session('message') }}</div>
                            @endif
                        </div>
                        <div>
                            <label id="sqCounter" name="sqCounter" style="display: none;"></label>
                            <label id="base_rate_label" name="base_rate" style="display: none;"></label>
                            <label id="max_seats" name="max_seats" style="display: none;"></label>

                        </div>
                        <div>
                            <label for="payment">Método de pago:</label>
                            <select name="payment" id="payment" class="form-control">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Cŕedito">Tarjeta de Crédito</option>
                                <option value="Débito">Tarjeta de Débito</option>
                                <option value="Paypal">PayPal</option>
                            </select>
                        </div>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


                        <script>
                            $(document).ready(function() {
                                // Manejo del cambio en el elemento con ID 'origin'
                                $('#origin').on('change', function() {
                                    // Obtén el valor seleccionado en el campo de origen
                                    var selectedOrigin = $(this).val();
                                    // Obtén el elemento de destinoSelect
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
                                    // Triggers change event on destinoSelect to update base rate when origin changes
                                    destinoSelect.trigger('change');
                                });

                                // Manejo del cambio en el elemento con ID 'destinoSelect'
                                $('#destinoSelect').on('change', function() {
                                    // Obtiene la ruta seleccionada
                                    var selectedDestiny = $(this).val();

                                    // Busca la información de la ruta en el array de rutas
                                    var routeInfo = @json($routes).find(function(route) {
                                        return route.destiny === selectedDestiny;
                                    });

                                    // Verifica si se encontró la información de la ruta
                                    if (routeInfo) {
                                        var baseRate = routeInfo.base_rate;
                                        var sq = routeInfo.seat_quantity;

                                        // Puedes hacer algo con el baseRate, por ejemplo, mostrarlo en el label
                                        $('#base_rate_label').text(baseRate);
                                        $('#max_seats').text(sq);

                                        // Triggers change event on base_rate_label to ensure it updates automatically
                                        $('#base_rate_label').trigger('change');
                                        $('#max_seats').trigger('change');

                                    }
                                });

                                // Inicializa el selector de destino al cargar la página
                                $('#origin').trigger('change');
                            });
                        </script>

                        <script>
                            //validacion de
                            function validateInput(input) {
                                const value = input.value;
                                if (value === "0" || value < 1) {
                                    input.value = "1";
                                }
                            }

                            function getMaxSeats(qqqqqq) {
                                var max_seats = route.seat_quantity;
                                return max_seats;
                            }
                        </script>

                        {{-- <label id="base_rate_label" name="base_rate" onchange="actualizarBaseRate()"></label>
                    <label id="max_seats" name="max_seats" onchange="actualizarMaxSeats()"></label>
                    <label id="sqCounter" name="sqCounter" onchange="actualizarSqCounter()"></label> --}}



                        @csrf
                        <button id="reservarButton" type="submit" class="btn btn-primary"
                        data-toggle="tooltip" data-placement="top" title="Haz clic para reservar">Reservar</button>
                        <script src="{{ asset('js/app.js') }}"></script>


                        <script>
                            const swalWithBootstrapButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: "btn btn-success swal-btn-confirm",
                                    cancelButton: "btn btn-danger swal-btn-cancel"
                                },
                                buttonsStyling: false
                            });

                            function showSwal(origen, destiny, fecha, seat_quantity, base_rate_label, paymentMethod) {
                                return new Promise((resolve) => {
                                    swalWithBootstrapButtons.fire({
                                        text: `El total de la reserva entre  ${origen} y ${destiny} para el día ${fecha} de $${(base_rate_label*seat_quantity).toLocaleString('es-CL', { minimumFractionDigits: 0 })} (${seat_quantity} asientos) con método de pago ${paymentMethod}. ¿Desea continuar?`,
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

                            document.getElementById('reservarButton').addEventListener('click', async function(event) {
                                event.preventDefault();

                                var origen = $('#origin').val();
                                var destiny = $('#destinoSelect').val();
                                var fecha = $("#date").val().split('-');
                                if (fecha.length === 3) {
                                    fecha = fecha[2] + '/' + fecha[1] + '/' + fecha[0];
                                }
                                var seat_quantity = $("#seat_quantity").val();
                                var base_rate = $("#base_rate_label").text();
                                var paymentMethod = $("#payment").val();

                                if (!origen || !destiny || !fecha || !seat_quantity || !base_rate || !paymentMethod) {
                                    swalWithBootstrapButtons.fire({
                                        title: "Error",
                                        text: "Por favor, complete todos los campos antes de continuar",
                                        icon: "error"
                                    });
                                    return;
                                }

                                const isConfirmed = await showSwal(origen, destiny, fecha, seat_quantity, base_rate, paymentMethod);

                                if (isConfirmed) {
                                    event.target.form.submit();
                                } else {
                                    swalWithBootstrapButtons.fire({
                                        title: "Reserva cancelada!",
                                        text: "Tu reserva ha sido cancelada",
                                        icon: "error"
                                    });
                                }
                            });
                        </script>
            </form>
        @endif

    </div>
</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
    $(document).ready(function() {
        $('#date').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
            showOtherMonths: true,
            selectOtherMonths: true,
            autoclose: true,
            changeMonth: true,
            changeYear: true,
        });
    })
</script>
<script src="//cdn.tutorialjinni.com/jquery/3.6.1/jquery.min.js"></script>
<script src="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script src="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/js/bootstrap-select-country.min.js"></script>

</html>
