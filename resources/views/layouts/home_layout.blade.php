<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Sistema de Apoyo a la empresa TIS - SATIS</title>
  <!-- Favicon -->
  <link rel="icon" href="/assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="/assets/css/argon.css?v=1.2.0" type="text/css">
  <link href="/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js" integrity="sha512-9WciDs0XP20sojTJ9E7mChDXy6pcO0qHpwbEJID1YVavz2H6QBz5eLoDD8lseZOb2yGT8xDNIV7HIe1ZbuiDWg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href=" {{ route('home') }} ">
          <h1>EmpujeSoft</h1>
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            @if ($user_type == 'asesor_tis')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('postPublication') }}">
                <i class="fas fa-bullhorn text-dark"></i>

                <span class="nav-link-text">Nueva Publicación</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('createActivity') }}">
                <i class="fas fa-tasks text-primary"></i>

                <span class="nav-link-text">Crear Actividad</span>
              </a>
            </li>
            @endif

            <li class="nav-item">
              <a class="nav-link" href={{ route('listGE') }}>
                <i class="ni ni-bullet-list-67 text-green"></i>
                <span class="nav-link-text">Listar GE</span>
              </a>
            </li>
            @if($user_type == 'admin')
            <li class="nav-item">
              <a class="nav-link" href={{ route('crearGrupo') }}>

                <i class="fa fa-users text-blue" aria-hidden="true"></i>
                <span class="nav-link-text">Crear Grupo</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href={{ route('createSemester') }}>

                <i class="fa fa-users text-blue" aria-hidden="true"></i>
                <span class="nav-link-text">Crear Semestre</span>
              </a>
            </li>
            @endif

            @if($user_type == 'estudiante')
            <li class="nav-item">
              <a class="nav-link" href={{ route('registerGE') }}>

                <i class="fa fa-users text-blue" aria-hidden="true"></i>
                <span class="nav-link-text">Registrar GE</span>
              </a>
            </li>
            @endif

            @if($user_type == 'asesor_tis')
            <li class="nav-item">
              <a class="nav-link" href={{ route('template') }}>
                <i class="far fa-file-text text-yellow"></i>
                <span class="nav-link-text">Plantillas</span>
              </a>
            </li>
            @endif
          </ul>
          <!-- Divider -->
          <hr class="my-3">
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->

  <div class="main-content" id="panel">
    <!-- Topnav -->

    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">




      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">

            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form>

{{-- *********************************************************************************** --}}
{{-- *****************         Titulo de la pestaña principal   ************************ --}}
{{-- *********************************************************************************** --}}

<div class='container-fluid'>
  <div class='mx-auto'>
      <h6 class='h2 text-white d-inline-block'>{{$title}}</h6>
  </div>
</div>

{{-- *********************************************************************************** --}}
{{-- *********************************************************************************** --}}
{{-- *********************************************************************************** --}}

          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>


          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="https://cdn.pixabay.com/photo/2017/02/25/22/04/user-icon-2098873_1280.png">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->name}}</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">

                <div class="dropdown-divider"></div>
                <a href="{{ url('/logout') }}" method="get" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Cerrar Sesión</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
{{--
    <div class="header bg-primary pb-2">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Default</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div> --}}

<main class="p-2">
    @yield('content')
</main>

  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="/assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="/assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="/assets/js/argon.js?v=1.2.0"></script>
  @yield('scripts')
</body>

</html>
