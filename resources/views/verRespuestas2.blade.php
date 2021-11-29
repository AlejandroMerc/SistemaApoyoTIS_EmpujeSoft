@extends('layouts.app')



@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-standalone.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">{{ __('Lista de Asignados') }}</div>
                    <div class="card w-20">
                        <div class="card-body">
                            <h5 class="card-title">Nombre Est 1</h5>
                                <a href="#" class="btn btn-primary">Ver Respuestas</a>
                        </div>
                    </div>
                    <div class="card w-20">
                        <div class="card-body">
                            <h5 class="card-title">Nombre Est 2</h5>
                                <a href="#" class="btn btn-primary">Ver Respuestas</a>
                        </div>
                    </div>
                    <div class="card w-20">
                        <div class="card-body">
                            <h5 class="card-title">Nombre Est 3</h5>
                                <a href="#" class="btn btn-primary">Ver Respuestas</a>
                        </div>
                    </div>
                    <div class="card w-20">
                        <div class="card-body">
                            <h5 class="card-title">Nombre Est 4</h5>
                                <a href="#" class="btn btn-primary">Ver Respuestas</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">{{ __('Archivos') }}</div>
                        <div class="card w-20">
                            <div class="card-body">
                                <h5 class="card-title">Entregado</h5>
                                
                                    <a href="#" class="btn btn-primary">Orden de Cambio</a>
                                    <a href="#" class="btn btn-primary">Aceptar Respuesta</a>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"> </script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection