<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SATIS</title>

    <!-- Styles -->
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
    <!-- Scripts
    <script type ="text/javascript">
        var baseURL = {!! json_encode(url('/')) !!}
    </script>
    -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <b>Sistema de Apoyo para TIS </b>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <h6 class="text-white"><b>{{ __('Iniciar Sesion') }}</b></h6>
                                    </a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register-student-view'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register-adviser-view') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register-student-view') }}">
                                    <h6 class="text-white"><b>{{ __('Registrar Estudiante') }}</b></h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register-adviser-view') }}">
                                    <h6 class="text-white"><b>{{ __('Registrar Asesor') }}</b></h6>
                                </a>
                            </li>
                        @else
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <b><i class="fas fa-user-circle"></i> {{ Auth::user()->name }}</b>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                          <i class="fas fa-running"></i>
                                        {{ __('Cerrar Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="get" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    <script type ="text/javascript">
        var baseURL = {!! json_encode(url('/')) !!}
    </script>
    <main class="py-4">
        @yield('content')
    </main>
    <script src="{{ asset('js/calendario.js') }}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        if ( '{{Session::has('alert-success')}}'){
            swal('Bien','{{Session::get('alert-success')}}','success', {button: 'cerrar'});
        } else if ('{{Session::has('alert-error')}}') {
            swal('Oops...','{{Session::get('alert-error')}}','error', {button: 'cerrar'});
        }
    </script>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
          $(".btn-outline-success").click(function(){
              var lsthmtl = $(".clone").html();
              $(".increment").after(lsthmtl);
          });
          $("body").on("click",".btn-outline-danger",function(){
              $(this).parents(".hdtuto").remove();
          });
        });
    </script>
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

</body>

    <!-- Footer -->
        <footer  id ="footer"class="container-fluid  pt-5 pb-4 mt-5">

        <!-- Footer Links -->
        <div class="container text-center text-md-left">

            <!-- Grid row -->
            <div class="row">

            <!-- Grid column -->
            <div class="col-md-4 col-lg-4 mr-auto my-md-4 my-0 mt-4 mb-1">

                <!-- Content -->
                <h5 class="font-weight-bold text-uppercase mb-4 text-white">Acerca de Nosotros - Empuje Soft</h5>
                <p style="color: white ; aling:justify">Somos un grupo de estudiantes de la universidad Mayor de San Simon
                                        de la carrera de Taller de Ingenieria de Software   
                </p>
                <h5 class="font-weight-bold"style="color: white">SATIS</h5> 
                <p style="color: white">   
                SATIS es el acronimo de Sistema de Apoyo para Taller de Ingenieria de Software, este sistema ayudara
                a llevar un mejor control de las actividades, trabajos, de la materia de Taller de Ingenieria de Software.</p>

            </div>
            <!-- Grid column -->

            <hr class="clearfix w-200 d-md-none">

            <!-- Grid column -->

            <hr class="clearfix w-200 d-md-none">

            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 mx-auto my-md-4 my-0 mt-4 mb-1 text-white">

                <!-- Contact details -->
                <h5 class="font-weight-bold text-uppercase mb-4 text-white">Contactos</h5>

                <ul class="list-unstyled">
                <li>
                    <p>
                    <i class="fas fa-home mr-3"></i> Cochabamba - Bolivia </p>
                </li>
                <li>
                    <p>
                    <i class="fas fa-envelope mr-3"></i> empujesoft.tis@gmail.com</p>
                </li>
                <li>
                    <p>
                    <i class="fas fa-phone mr-3"></i> +591 79723780</p>
                </li>
                </ul>

            </div>
            <!-- Grid column -->

            <hr class="clearfix w-200 d-md-none">

            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 text-center mx-auto my-4">

                <!-- Social buttons -->
                <h5 class="font-weight-bold text-uppercase mb-4 text-white">Redes Sociales</h5>

                <ul class="list-unstyled list-inline ">
                <li class="list-inline-item">
                <a href="https://www.facebook.com/EmpujeSoft-107188271849741" id="iconos"class="btn-floating mr-md-3 mr-2 fa-2x">
                    <i class="fab fa-facebook-f"></i>
                </a>
                </li>
                <li class="list-inline-item">
                <a href="https://github.com/"id="iconos"class="btn-floating mr-md-3 mr-2 fa-2x">
                    <i class="fab fa-github"></i>
                </a>
                </li>
                <li class="list-inline-item">
                <a href = "#linkIn" id="iconos" class="btn-floating mr-md-3 mr-2 fa-2x">
                    <i class="fas fa-book"></i>
                </a>
                </li>
            </ul>

            </div>
            <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3 text-white">© 2021 Copyright:
            <a style="color:white"href="https://mdbootstrap.com/"> EmpujeSoft</a>
        </div>
        <!-- Copyright -->

        </footer>
        <!-- Footer -->
</html>
