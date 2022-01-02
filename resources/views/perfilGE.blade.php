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
                <img style="col-form-label;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTNVKsuPVT86fBsz0f9l-s9Uu2Nz4oqMJE4PA&usqp=CAU">
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