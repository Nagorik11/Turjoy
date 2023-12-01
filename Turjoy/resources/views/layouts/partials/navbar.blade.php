<header class="p-3" style="background-color: #0a74da; color: #f3f3f3;">
<div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

      </ul>

      @auth

        {{auth()->user()->name}}
        <div class="text-end px-2">
          <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Cerrar sesión</a>
        </div>
      @endauth

      @guest
        <div class="text-end">
          <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Iniciar Sesión</a>
        </div>
      @endguest
    </div>
  </div>
</header>
