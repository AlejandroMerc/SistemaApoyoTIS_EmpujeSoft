@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrar Grupo Empresa') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('registerGE') }}">
                        @csrf
                        <div class="form-group row ">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Corto') }}</label>
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
                        <label for="nameLarge" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Largo') }}</label>
                            <div class="col-md-6">
                                    <input id="nameLarge" type="text" class="form-control @error('name') is-invalid @enderror" name="nameLarge" value="{{ old('nameLarge') }}" required autocomplete="nameLarge" autofocus>
                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="telf" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>
                            <div class="col-md-6">
                                    <input id="telf" type="number" class="form-control @error('email') is-invalid @enderror" min="190000000" max="999999999" name = "telf" value="{{ old('telf') }}" required autocomplete="telf">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="sociedad" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Sociedad') }}</label>
                            <div class="col-md-6 ">
                                <select id="sociedad"  class="form-control @error('email') is-invalid @enderror" name="sociedad" value="{{ old('sociedad') }}" required autocomplete="sociedad">
                                    <option value="volvo">S.A</option>
                                    <option value="volvo2">ASL</option>
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
                            <label for="direc" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>
                            <div class="col-md-6">
                                    <input id="direc" type="text" class="form-control @error('name') is-invalid @enderror" name="direc" value="{{ old('direc') }}" required autocomplete="direc" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="aniadirMiembros" class="col-md-4 col-form-label text-md-right">{{ __('Añadir Miembros') }}</label>
                            <div class="col-md-6">
                                    <div class="row" >
                                        <div class="col-auto">
                                            <input id="aniadirMiembros" type="email" class="form-control @error('email') is-invalid @enderror" name="aniadirMiembros" value="{{ old('aniadirMiembros') }}" autocomplete="aniadirMiembros">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-primary " onclick="addMember()">
                                                    {{ __('Añadir') }}
                                            </button>
                                        </div>
                                   </div>
                            </div>
                        </div>


                        <div id="listMember">

                            {{-- <label for="table" class="col-md-4 col-form-label text-md-right">{{ __('Tabla') }}</label>
                            <div class="col-md-6">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Rol</th>
                                        </tr>
                                    </thead>
                                    @foreach ($members as $member)
                                        <tr>
                                            <th>{{ $member['name'] }}</th>
                                            <th>{{ $member['email'] }}</th>
                                            <th>{{ $member['rol'] }}</th>
                                        </tr>
                                    @endforeach
                                    <tbody>
                                        <tr>
                                            <th>1a</th>
                                            <th>asd</th>
                                            <th>sadasd</th>
                                        </tr>
                                        <tr>
                                            <th>sd</th>
                                            <th>ds</th>
                                            <th>as</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> --}}
                        </div>

                        <div class="form-group row mb-0">
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

<script>

    var id = 1;

    function addMember() {
        var memberEmail = document.getElementById('aniadirMiembros').value;

        // en esta parte debemos verificar mediante la base de datos, que el correo cumple con las especificaciones de usuario
        // no se como verificar que el correo esta cumpliendo los formatos requeridos
        // no se como mostrar alerta de errores :'v

        var divRowTag  =document.createElement('div');
        divRowTag.setAttribute('class', 'form-group row');

        var element = document.getElementById('listMember');

        var labelTag = document.createElement('label');
        labelTag.setAttribute('for', 'member'+id);
        labelTag.setAttribute('class', 'col-md-4 col-form-label text-md-right');
        labelTag.innerHTML = "Miembro " + id;

        var divTag = document.createElement('div');
        divTag.setAttribute('class', 'col-md-6');

        var inputTag = document.createElement('input');
        inputTag.setAttribute('id', 'member'+id);
        inputTag.setAttribute('type', 'text');
        inputTag.setAttribute('class', 'form-control');
        inputTag.setAttribute('name', 'member'+id);
        inputTag.setAttribute('value', memberEmail);
        inputTag.setAttribute('autocomplete', 'member'+id);
        inputTag.toggleAttribute('disabled');
        inputTag.appendChild(document.createTextNode(memberEmail));

        console.log("id: "+inputTag.getAttribute('id'));

        id++;
        divRowTag.appendChild(labelTag)
        divTag.appendChild(inputTag);
        divRowTag.appendChild(divTag);
        element.appendChild(divRowTag);
    }
</script>
@endsection
