<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>crearGrupo</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SATIS</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @yield('css')
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Sistema de Apoyo a la empresa TIS - SATIS
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
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        {{-- @if (Route::has('register-student-view'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register-adviser-view') }}">{{ __('Register') }}</a>
                            </li>
                        @endif --}}

                        @if (Route::currentRouteName() == 'register-adviser-view')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register-student-view') }}">{{ __('Registrar Estudiante') }}</a>
                            </li>
                        @elseif (Route::currentRouteName() == 'register-student-view')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register-adviser-view') }}">{{ __('Registrar Asesor') }}</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register-student-view') }}">{{ __('Registrarse') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
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
    <div class="container-sm border mt-3">
        <div class="row">
            <div class="col-sm-11 mt-3 mb-3">
                <div class="text-center">
                    <h3>Crear grupo de materia</h3>
                </div>
            </div>

        </div>
        <div class="row mx-auto">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 border">
                <form action="/action_page.php" class="was-validated">
                    <div class="row">
                      <div class="col-sm-4">
                        <label for="uname" class="form-label">Nombre de grupo:</label>
                      </div>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="uname" placeholder="Nombre de grupo " name="uname" required>
                        <div class="valid-feedback">Valido.</div>
                        <div class="invalid-feedback">Por favor rellene este campo.</div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="uname" class="form-label">Docente:</label>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group mt-3 mb-3">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                Docente
                                </button>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Leticia</a></li>
                                <li><a class="dropdown-item" href="#">Corina</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="uname" class="form-label">Codigo inscripcion:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="uname" placeholder="Codigo de inscripcion" name="uname" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="uname" class="form-label">Semestre:</label>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group mt-3 mb-3">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                  Semestre
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="#">Link 1</a></li>
                                  <li><a class="dropdown-item" href="#">Link 2</a></li>
                                  <li><a class="dropdown-item" href="#">Link 3</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <button type="submit" id="crear" class="btn btn-primary">crear grupo</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>


</body>
</html>
