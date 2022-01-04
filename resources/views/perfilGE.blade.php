@extends('layouts.home_layout')

@section('content')
    @csrf
    <div class="container-sm border mt-3">
        <div class="row">
            <div class="col-sm-11 mt-3 mb-3">
                <div class="text-center">
                    <h3>{{$grupoEmpresa->nombre_corto}}</h3>
                </div>
            </div>

        </div>
        <div class="row mx-auto" >
            <div class="col-sm-3">
                <img style="col-form-label;" src="data:image/png;base64,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">
            </div>
            <div class="col-sm-9 border" >
                <form  method="POST" class="needs-validation" novalidate >
                    @csrf
                    <div class="row" >
                        <div class="col-sm-4">
                            <i class="fas fa-user"></i>
                            <label for="sigla" class="form-label col-form-label"><h5>Nombre largo :</h5></label>
                        </div>
                        <div class="col-sm-8">
                            <label for="semestre" class="col-md-4 col-form-label text-md-left" >{{$grupoEmpresa->nombre_largo}}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="fas fa-sitemap"></i>
                            <label for="sigla" class="form-label col-form-label"><h5>Tipo de sociedad :</h5></label>
                        </div>
                        <div class="col-sm-8">
                            <label for="semestre" class="col-md-4 col-form-label text-md-left">{{$grupoEmpresa->tipo_sociedad}}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="fas fa-envelope"></i>
                            <label for="sigla" class="form-label col-form-label"><h5>Correo electronico :</h5></label>
                        </div>
                        <div class="col-sm-8">
                            <label for="semestre" class="col-md-4 col-form-label text-md-left">{{$grupoEmpresa->email}}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="fas fa-map-marker-alt"></i>
                            <label for="docente" class="form-label"><h5>Direccion :</h5></label>
                        </div>
                        <div class="col-sm-8">
                            <label for="semestre" class="col-md-4 col-form-label text-md-left">{{$grupoEmpresa->direccion_ge}}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="fas fa-phone-square-alt"></i>
                            <label for="semestre" class="form-label col-form-label"><h5>telefono :</h5></label>
                        </div>
                        <div class="col-sm-8">
                            <label for="semestre" class="col-md-4 col-form-label text-md-left">{{$grupoEmpresa->telefono_ge}}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="fas fa-users"></i>
                            <label for="semestre" class="form-label col-form-label"><h5>Integrantes:</h5></label>
                        </div>
                        <div class="col-sm-8">
                            <label for="semestre" class="col-md-4 col-form-label text-md-left" style="color:blue;">{{$representante->name}} {{$representante->lastname}}</label>
                            @foreach($integrantesArray as $integrante)
                                <label for="semestre" class="col-md-4 col-form-label text-md-left">{{$integrante->name}} {{$integrante->lastname}}</label>
                            @endforeach
                        </div>
                    </div>
                        

                </form>
            </div>
            
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">

@endsection('content')