<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Cargar viajes | Turjoy</title>
</head>

<body>
    <center>
    <h2 class="text-3xl font-bold">CARGAR VIAJES</h2>
    </center>
    
    <label>
        <input type="file" accept=".xlsx" class="w-2/5 mx-1 block rounded-lg border-2 border-current border-slate-500
        file:bg-custom_blue"
        />
    </label>
    <p class="mx-1 text-sm text-gray-500">Solo se admiten archivos de tipo ".xlsx".</p>

</body>
</html>

