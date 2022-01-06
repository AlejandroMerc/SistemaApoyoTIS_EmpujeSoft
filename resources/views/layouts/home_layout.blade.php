<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">





  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Sistema de Apoyo a la empresa TIS - SATIS</title>

  <!-- Favicon -->
  <link rel="icon" href="/assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->

  <!-- Argon CSS -->
  <link rel="stylesheet" href="/assets/css/argon.css?v=1.2.0" type="text/css">

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js" integrity="sha512-9WciDs0XP20sojTJ9E7mChDXy6pcO0qHpwbEJID1YVavz2H6QBz5eLoDD8lseZOb2yGT8xDNIV7HIe1ZbuiDWg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.js"></script>



  @yield('css')

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">


  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>


  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href=" {{ route('home') }} ">
          <h1><i class="fab fa-centercode"></i> SATIS</h1>
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
                <h5>
                  <i class="fas fa-bullhorn text-dark"></i>

                  <span class="nav-link-text">Nueva Publicación</span>
                </h5>

              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('createActivity') }}">
                <h5>
                  <i class="fas fa-tasks text-primary"></i>

                  <span class="nav-link-text">Crear Actividad</span>
                </h5>

              </a>
            </li>
            @endif

            <li class="nav-item">
              <a class="nav-link" href={{ route('listGE') }}>
                <h5>
                  <i class="ni ni-bullet-list-67 text-green"></i>
                  <span class="nav-link-text">Listar GE</span>
                </h5>

              </a>
            </li>
            @if($user_type == 'admin')
            <li class="nav-item">
              <a class="nav-link" href={{ route('crearGrupo') }}>
                <h5>
                  <i class="fa fa-users text-blue" aria-hidden="true"></i>
                  <span class="nav-link-text">Crear Grupo</span>
                </h5>

              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href={{ route('createSemester') }}>
                <h5>
                  <i class="fa fa-users text-blue" aria-hidden="true"></i>
                  <span class="nav-link-text">Crear Semestre</span>
                </h5>

              </a>
            </li>
            @endif

            @if($user_type == 'estudiante')
            <li class="nav-item">
              <a class="nav-link" href={{ route('registerGE') }}>
                <h5>
                  <i class="fa fa-users text-blue" aria-hidden="true"></i>
                  <span class="nav-link-text">Registrar GE</span>
                </h5>

              </a>
            </li>

            @if ($title !== "Sin grupoempresa")
            <li class="nav-item">
              <a class="nav-link" href={{ route('calendarioGE') }}>
                <h5>
                  <i class="fas fa-calendar-day"></i>
                  <span class="nav-link-text">Planificacion</span>
                </h5>

              </a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href={{ route('calendarioTis') }}>
                <h5>
                  <i class="far fa-calendar-alt"></i>
                  <span class="nav-link-text">Calendario TIS</span>
                  </h5>

              </a>
            </li>
            @endif

            @if($user_type == 'asesor_tis')
            <li class="nav-item">
              <a class="nav-link" href={{ route('template') }}>
                <h5>
                  <i class="far fa-file-text text-yellow"></i>
                  <span class="nav-link-text">Plantillas</span>
                </h5>

              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href={{ route('calendarioTis') }}>
                <h5>
                  <i class="far fa-calendar-alt"></i>
                  <span class="nav-link-text">Calendario TIS</span>
                  </h5>

              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href={{ route('calendarioGE') }}>
               <h5>
                <i class="fas fa-calendar-day text-primary"></i>
                <span class="nav-link-text"> Calendario GE</span>
                 </h5>
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



          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item">
            <div class="dropdown dropleft">

                <a type="button" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="avatar avatar-sm rounded-circle">
                    <i class="far fa-user"></i>
                  </span>

                  <span class="mb-0 text-sm text-white font-weight-bold">{{Auth::user()->name}}</span>

                </a>
              <div class="dropdown-menu">
                <a href="{{ url('/logout') }}" method="get" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Cerrar Sesión</span>
                </a>
              </div>
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

    <script type ="text/javascript">
        var baseURL = {!! json_encode(url('/')) !!}
    </script>

<main class="p-2">
    @yield('content')
</main>

  <script src="{{ asset('js/calendario.js') }}" ></script>

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

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>


  @yield('scripts')
</body>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"> </script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

    <script>
      $('#tablaGE').DataTable({
          responsive:true,
          autoWidth:false,

      "language": {
          "lengthMenu": "Mostrar _MENU_ registros por página",
          "zeroRecords": "No hay resultados",
          "info": "Mostrando página _PAGE_ de _PAGES_",
          "infoEmpty": "No existen registros",
          "infoFiltered": "(filtrado de _MAX_ registros totales)",
          "search": "Buscar",
          "paginate":{
              "next":"Siguiente",
              "previous":"Anterior"
          }
      }
      });

    </script>
</html>
