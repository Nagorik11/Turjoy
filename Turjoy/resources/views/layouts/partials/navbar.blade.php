<header class="p-3" style="background-color: #0a74da; color: #f3f3f3;">
<div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-link px-2 text-white">Reservar Pasajes</a></li>
        <li><a href="#" class="nav-link px-2 text-white">Buscar Reservas</a></li>
      </ul>


      @auth
        {{auth()->user()->name}}
        <div class="text-end px-2">
          <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Cerrar sesión</a>
        </div>
      @endauth

      @guest
        <div class="text-end">
          <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
          <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
        </div>
      @endguest
    </div>
  </div>
</header>
