<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Turjoy</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        footer {
            color: #333;
            text-align: center;
            padding: 10px;
        }
        .large-card {
            height: 500px;
        }
        .cards-container {
            padding-top: 120px;
        }
        .custom-card {
            background-color: #0A74DA;
            color: white;
        }
        h2 {
            padding-top: 30px;
        }
        img {
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <header class="border-bottom">
        <div class="container">
            <nav class="header-nav">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand" href="/">
                        <img src="{{ URL('images/turjoylogo.png') }}" width="100" height="100">
                    </a>
                    <a href="login" class="btn btn-primary ml-auto">Iniciar Sesión</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <div class="container cards-container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card large-card custom-card text-center">
                        <div class="card-body">
                            <div id="carouselExampleSlidesOnly1" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ URL('images/desierto.jpg') }}" height="270" width="500" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ URL('images/mano.jpg') }}" height="270" width="500" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ URL('images/montaña.jpg') }}" height="270" width="500" class="d-block w-100">
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-title text-center">Reservar pasaje</h2>
                            <p class="card-text text-center">Reserva tus viajes de manera fácil y sencilla. ¡No te quedes sin tu asiento, asegura tu fecha y pasaje ahora en Turjoy!</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-light">Comprar pasaje</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card large-card custom-card text-center">
                        <div class="card-body">
                            <div id="carouselExampleSlidesOnly2" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ URL('images/palafito.jpg') }}" height="270" width="500" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ URL('images/stgo.jpg') }}" height="270" width="500" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ URL('images/valpo.jpg') }}" height="270" width="500" class="d-block w-100">
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-title">Buscar reserva</h2>
                            <p class="card-text">¡Revisa y accede a todos los detalles de tu reserva en un abrir y cerrar de ojos. Explora y revisa todos los detalles de tu viaje.</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-light">Buscar tu reserva</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container text-center">
            Codecrafters &copy; <script>document.write(new Date().getFullYear())</script>
        </div>
    </footer>

    <script>
        $(document).ready(function () {
            $('#carouselExampleSlidesOnly1, #carouselExampleSlidesOnly2').carousel({
                interval: 1000,
                pause: false,
                wrap: true,
            });
        });
    </script>
</body>
</html>
