@extends('layouts.home_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border border-dark rounded-lg">
                <div class="card-header bg-primary text-white"><h5 class="text-white">{{ __('Registrar Grupo Empresa') }}</h5></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register-ge-data') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row ">
                        <label for="nombre_corto" class="col-md-4 col-form-label text-md-right">{{ __('*Nombre Corto') }}</label>
                            <div class="col-md-6">
                                    <input id="nombre_corto" type="text" class="form-control @error('nombre_corto') is-invalid @enderror" name="nombre_corto" value="{{ old('nombre_corto') }}" required autocomplete="nombre_corto" autofocus>
                                    @error('nombre_corto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="nombre_largo" class="col-md-4 col-form-label text-md-right">{{ __('*Nombre Largo') }}</label>
                            <div class="col-md-6">
                                    <input id="nombre_largo" type="text" class="form-control @error('nombre_largo') is-invalid @enderror" name="nombre_largo" value="{{ old('nombre_largo') }}" required autocomplete="nombre_largo" autofocus>
                                        @error('nombre_largo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="telefono_ge" class="col-md-4 col-form-label text-md-right">{{ __('*Telefono') }}</label>
                            <div class="col-md-6">
                                    <input id="telefono_ge" type="number" class="form-control @error('telefono_ge') is-invalid @enderror" min="1000000" max="99999999" name = "telefono_ge" value="{{ old('telefono_ge') }}" required autocomplete="telefono_ge">
                                    @error('telefono_ge')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="tipo_sociedad" class="col-md-4 col-form-label text-md-right">{{ __('*Tipo de Sociedad') }}</label>
                            <div class="col-md-6 ">
                                <select id="tipo_sociedad"  class="form-control @error('tipo_sociedad') is-invalid @enderror" name="tipo_sociedad" value="{{ old('tipo_sociedad') }}" required autocomplete="tipo_sociedad">
                                    <option value="S.A.">S.A</option>
                                    <option value="S.R.L.">S.R.L.</option>
                                </select>
                                @error('tipo_sociedad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('*Correo') }}</label>
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
                            <label for="direccion_ge" class="col-md-4 col-form-label text-md-right">{{ __('*Direccion') }}</label>
                            <div class="col-md-6">
                                    <input id="direccion_ge" type="text" class="form-control @error('name') is-invalid @enderror" name="direccion_ge" value="{{ old('direccion_ge') }}" required autocomplete="direccion_ge" autofocus>
                                        @error('direccion_ge')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-group" class="col-md-4 col-form-label text-md-right">*Correos Miembros <br> (3-5 Integrantes)</label>
        

                            <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <input type="email" class="form-control @error('correoRepresentanteLegal') is-invalid @enderror" name="correoRepresentanteLegal" value="{{ old('correoRepresentanteLegal') }}" placeholder="Representante Legal">
                                    @error('correoRepresentanteLegal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                     @enderror
                                </li>
                                <li class="list-group-item">
                                    <input type="email" class="form-control @error('correoMiembro2') is-invalid @enderror" name="correoMiembro2" value="{{ old('correoMiembro2') }}" placeholder="Miembro 2">
                                    @error('correoMiembro2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                     @enderror
                                </li>
                                <li class="list-group-item">
                                    <input type="email" class="form-control @error('correoMiembro3') is-invalid @enderror" name="correoMiembro3" value="{{ old('correoMiembro3') }}"  placeholder="Miembro 3">
                                    @error('correoMiembro3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                     @enderror
                                </li>
                                <li class="list-group-item">
                                    <input type="email" class="form-control @error('correoMiembro4') is-invalid @enderror" name="correoMiembro4" value="{{ old('correoMiembro4') }}" placeholder="Miembro 4">
                                    @error('correoMiembro4')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                     @enderror
                                </li>
                                <li class="list-group-item">
                                    <input type="email" class="form-control @error('correoMiembro5') is-invalid @enderror" name="correoMiembro5" value="{{ old('correoMiembro5') }}" placeholder="Miembro 5">
                                    @error('correoMiembro5')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                     @enderror
                                </li>
                               
                            </ul>
                        </div>
                                    
                            </div>
                           
                        </div>

                        <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('*Logo') }}</label>
                            <div class="col-md-6">
                                    <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" required autofocus accept="image/*">
                                        @error('logo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append(
            '<tr><td><div><input id="miembros[' + i +
            ']" type="email" class="form-control @error("miembros[' + i +
            ']") is-invalid @enderror" name="miembros[' + i +
            ']" placeholder="Correo Miembro" value="{{ old("miembros[' + i +
            ']") }}" required autocomplete="miembros[' + i +
            ']">@error("miembros[' + i +
            ']")<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Eliminar Miembro</button></td></tr></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
<script>
     var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
</script>
@endsection
