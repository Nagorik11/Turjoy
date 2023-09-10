<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="resources/css/app.css"> <!-- Asegúrate de que la ruta al archivo CSS de Tailwind sea correcta -->
  <title>Turjoy</title>
</head>
<body class="bg-gray-100">
  <div class="container mx-auto p-4">
    <!-- Encabezado -->
    <header class="text-center">
      <h1 class="text-3xl font-bold underline text-blue-700">Bienvenido a Turjoy</h1>
      <p class="text-gray-600">Explora nuestro contenido</p>
    </header>
    
    <!-- Menú de navegación -->
    <nav class="mt-16">
      <ul class="flex space-x-4">
        <li><a href="#" class="text-blue-500 hover:text-blue-700">Iniciar sesión</a></li>
        <li><a href="#" class="text-blue-500 hover:text-blue-700">Acerca de Nosotros</a></li>
        <li><a href="#" class="text-blue-500 hover:text-blue-700">Servicios</a></li>
        <li><a href="#" class="text-blue-500 hover:text-blue-700">Contacto</a></li>
      </ul>
    </nav>
    
    <!-- Contenido principal -->
    <main class="mt-8">
      <section class="bg-white rounded-lg shadow-md p-4">
        <h2 class="text-2xl font-bold text-green-600">Nuestros Servicios</h2>
        <p>Ofrecemos una amplia gama de servicios para satisfacer tus necesidades.</p>
        <ul class="list-disc ml-6 mt-2">
          <li class="text-purple-500">Servicio 1</li>
          <li class="text-purple-500">Servicio 2</li>
          <li class="text-purple-500">Servicio 3</li>
        </ul>
      </section>
      
    <section class="mt-6 ">
              <h2 class="text-2xl font-bold text-indigo-600">Contacto</h2>
        <p>Puedes ponerte en contacto con nosotros en cualquier momento.</p>
        <a href="contacto.html" class="text-blue-500 hover:underline">Ir a la página de contacto</a>
      </section>
    </main>
    
    <!-- Pie de página -->
    <footer class="mt-8 text-center text-gray-500">
      &copy; 2023 Mi Página Web. Todos los derechos reservados CodeCrafters.
    </footer>
  </div>
</body>
</html>
