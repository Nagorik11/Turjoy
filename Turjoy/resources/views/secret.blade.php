<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
     rel="stylesheet" rel = "stylesheet" crossorigin="anonymous">
</head>
<body>
     <div class="container">
        <header class = "d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                Pagina privada
            </a>
            <div class="col-md-3 text-end">
                <a href="{{route('logout')}}"><button type="button"
                class="btn btn-outline-primary me-2">Salir</button></a>
            </div>
        </header>
    </div>
    <article class="container">
        <h2>Tu sección Privada</h2>
</article>
</body>
</html>