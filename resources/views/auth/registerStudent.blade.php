@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-dark rounded-lg">
                <div class="card-header bg-primary text-white"><h5><b>{{ __('Registrar Estudiante') }}</b></h5></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register-student-data') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control @error('name') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="name" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cod_sis" class="col-md-4 col-form-label text-md-right">{{ __('Codigo Sis') }}</label>

                            <div class="col-md-6">
                                <input id="cod_sis" type="cod_sis" class="form-control @error('cod_sis') is-invalid @enderror" name="cod_sis" value="{{ old('cod_sis') }}" required autocomplete="cod_sis">

                                @error('cod_sis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="carrera" class="col-md-4 col-form-label text-md-right">{{ __('Carrera') }}</label>

                            <div class="col-md-6">
                                <select id="carrera"  class="form-control @error('carrera') is-invalid @enderror" name="carrera" value="{{ old('carrera') }}" required autocomplete="carrera">
                                    <option value="informatica">Ingenieria Informatica</option>
                                    <option value="sistemas">Ingenieria Sistemas</option>
                                </select>
                                @error('required')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="codigo_inscripcion" class="col-md-4 col-form-label text-md-right">{{ __('Código de Inscripcion') }}</label>

                            <div class="col-md-6">
                                <input id="codigo_inscripcion" type="text" class="form-control @error('codigo_inscripcion') is-invalid @enderror" name="codigo_inscripcion" value="{{ old('codigo_inscripcion') }}" required autocomplete="codigo_inscripcion" autofocus>

                                @error('codigo_inscripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grupo" class="col-md-4 col-form-label text-md-right">{{ __('Grupo') }}</label>

                            <div class="col-md-6">
                                <select id="grupo"  class="form-control @error('grupo') is-invalid @enderror" name="grupo" value="{{ old('grupo') }}" required autocomplete="grupo">
                                    @foreach ($grupos as $grupo)
                                        <option value={{$grupo->id}}>{{$grupo->sigla_grupo}}</option>
                                    @endforeach
                                </select>
                                @error('required')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
