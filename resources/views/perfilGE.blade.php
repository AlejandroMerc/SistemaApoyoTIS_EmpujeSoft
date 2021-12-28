@extends('layouts.home_layout')

@section('content')

    <div class="container-sm border mt-3">
        <div class="row">
            <div class="col-sm-11 mt-3 mb-3">
                <div class="text-center">
                    <h3>EmpujeSoft</h3>
                </div>
            </div>

        </div>
        <div class="row mx-auto">
            <div class="col-sm-3">
                <img style="border: 1px solid; color: black;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTNVKsuPVT86fBsz0f9l-s9Uu2Nz4oqMJE4PA&usqp=CAU">
            </div>
            <div class="col-sm-6 border">
                <form  method="POST" class="needs-validation" novalidate >
                    @csrf
                    <div class="row">
                        <div class="col-sm-5">
                            <i class="fas fa-user"></i>
                            <label for="sigla" class="form-label"><h5>Nombre largo:</h5></label>
                        </div>
                        <div class="col-sm-7">
                            <label for="semestre" class="col-md-4 col-form-label text-md-right">EmpujeSoft SRL</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <i class="fas fa-sitemap"></i>
                            <label for="sigla" class="form-label"><h5>Tipo de sociedad:</h5></label>
                        </div>
                        <div class="col-sm-7">
                            <label for="semestre" class="col-md-4 col-form-label text-md-right">SRL</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <i class="fas fa-envelope"></i>
                            <label for="sigla" class="form-label"><h5>Correo electronico:</h5></label>
                        </div>
                        <div class="col-sm-7">
                            <label for="semestre" class="col-md-4 col-form-label text-md-right">empuje@gmail.com</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <i class="fas fa-map-marker-alt"></i>
                            <label for="docente" class="form-label"><h5>Direccion:</h5></label>
                        </div>
                        <div class="col-sm-7">
                            <label for="semestre" class="col-md-4 col-form-label text-md-right">Av. Heroinas Nro110</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <i class="fas fa-phone-square-alt"></i>
                            <label for="codigoInscricion" class="form-label"><h5>telefono:</h5></label>
                        </div>
                        <div class="col-sm-7">
                            <label for="semestre" class="col-md-4 col-form-label text-md-right">4377998</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <i class="fas fa-users"></i>
                            <label for="semestre" class="col-md-4 col-form-label text-md-right"><h5>Integrantes</h5></label>
                        </div>
                        <div class="col-sm-7">
                            <label for="semestre" class="col-md-4 col-form-label text-md-right">Pedro Perez</label>
                            <label for="semestre" class="col-md-4 col-form-label text-md-right">Marco Lopez</label>
                            <label for="semestre" class="col-md-4 col-form-label text-md-right">Freddy Mendez</label>
                            <label for="semestre" class="col-md-4 col-form-label text-md-right">Alex Silva</label>
                            <label for="semestre" class="col-md-4 col-form-label text-md-right">Juan Martinez</label>
                            <label for="semestre" class="col-md-4 col-form-label text-md-right">Pedro Perez</label>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">

@endsection('content')