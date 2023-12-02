<header class="p-3" style="background-color: #0a74da; color: #f3f3f3;">
  
<div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      
      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <!-- <a class="header-container navbar-brand" href="/">
          <img href="/" class="header-logo" src="{{ URL('images/turjoylogo.png') }}" height="90" width="90">
        </a>   -->
        
        <a href="/" class="btn btn-outline-light me-2">Inicio</a>
        @auth
          <a href="/reservation-report" class="btn btn-outline-light me-2">Reporte Reservas</a>
          <a href="/home" class="btn btn-outline-light me-2">Cargar Rutas</a>
        @endauth
        
      </ul>

      @auth
        
        <div class="text-end px-2">
          {{auth()->user()->name}}
          <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Cerrar sesión</a>
        </div>
      @endauth

      @guest
        <div class="text-end">
          <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
        </div>
      @endguest
    </div>
  </div>
</header>
