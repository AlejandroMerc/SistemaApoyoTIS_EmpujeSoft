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
           
                <i class="fas fa-info-circle fa-fw"> </i><h5 class="">Descripción titulo</h5>
          
            
        </div>    <br>
        <div class="row ">
            <i class="far fa-calendar fa-fw"></i> <h5 class="">Fecha de Entrega</h5>
        </div> 
        <br>
        <div class="row ">
            <i class="far fa-folder"></i>  <h5 class="">Cantidad de archivos permitidos</h5>
        </div>      
        <br>
        <div class="row ">
            <i class="far fa-file"></i> <h5 class="">Formato permitido</h5>
        </div>  
        <br>
          
                    <form method="POST" action="{{ route('registir-activity-data') }}" enctype="multipart/form-data">
                        @csrf
                       
                        
                    </form>
                
            
        </div>
    </div>
</div>
    
@endsection