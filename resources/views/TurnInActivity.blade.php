@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
                
        <div class="row justify-content-center">
            <h3 class="text-bold">{{ __('Título Actividad') }}</h3>
        </div>
        <br>
        <div class="row ">
           
                <i class="fas fa-info-circle fa-fw"> </i><h5 class="">Descripción titulo es esta</h5>
          
            
        </div>    <br>
        <div class="row ">
            <i class="far fa-calendar fa-fw"></i> <h5 class="">Fecha de Entrega: 30-12-2021 08:00</h5>
        </div> 
        <br>
        <div class="row ">
            <i class="far fa-folder"></i>  <h5 class="">Cantidad de archivos permitidos: 2</h5>
        </div>      
        <br>
        <div class="row ">
            <i class="far fa-file"></i> <h5 class="">Formato permitido: Documentos</h5>
        </div>  
        <br>
          
                    <form method="POST" action="{{ route('registir-activity-data') }}" enctype="multipart/form-data">
                        @csrf
                       
                        
                    </form>
                
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Adjuntar Archivos para Entrega
                        </div>
                        <div class="card-body">
                            <form  method="post" enctype="multipart/form-data" class="dropzone dz-clickable" id="image-upload">
                                @csrf
                                <div>
                                    <h3 class="text-center"> <i class="fas fa-upload"></i> Subir archivos </h3>
                                </div>
                                <div class="dz-default dz-message">
                                    <span> Arrastre archivos aquí para subir</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </div>
</div>
    
@endsection