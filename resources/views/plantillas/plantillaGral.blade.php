<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'NetMex')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.3.0-web/css/all.css">
    <link rel="stylesheet" href="css/estilos.css">
    @yield("estilos")
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
<body class="bg-dark text-white">
    <div class="color-navegacion logo">
        <h1 class="text-center text-white"><a href="{{ route('principal') }}" class="nav-link">NetMex</a></h1>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light color-navegacion">
        <div class="container-fluid d-flex justify-content-end">

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link text-white p-3 enlace" aria-current="page" href="#">Nosotros</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white p-3 enlace" href="#">Contacto</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white p-3 enlace" href="#">Favoritos</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control" type="search" placeholder="Search" aria-label="Search">
              <button class="me-1 bg-transparent border-0 text-white" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <div class="dropdown d-flex justify-content-end mt-1">
              <a class="nav-link  imgPerfil" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ Auth::user()->imagen }}" class="p"  alt=""
                  loading="lazy" />
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('perfil') }}">Mi perfil</a></li>
                <li><a class="dropdown-item" href="#">Historial</a></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar Sesión</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

      
  @yield('contenido')

  
  
  @include('sweetalert::alert')
  
  @yield('javascript')
</body>
</html>