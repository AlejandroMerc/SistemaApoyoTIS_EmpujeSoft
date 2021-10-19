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
                                    <option value="volvo">ASL</option>
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
                                            <input id="aniadirMiembros" type="email" class="form-control @error('email') is-invalid @enderror" name="aniadirMiembros" value="{{ old('aniadirMiembros') }}" required autocomplete="aniadirMiembros">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div> 
                                        <div class="col-auto"> 
                                            <button type="submit" class="btn btn-primary ">
                                                    {{ __('Añadir') }}
                                            </button> 
                                        </div>
                                   </div>           
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            <label for="table" class="col-md-4 col-form-label text-md-right">{{ __('Tabla') }}</label>
                            <div class="col-md-6">                               
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Rol</th>
                                        </tr>    
                                    </thead>
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
                            </div>
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
@endsection