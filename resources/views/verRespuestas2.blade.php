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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Lista de Asignados') }}</div>
                    <div class="card w-20">
                        @foreach ($asignados as $asignado)
                            <div class="card-body">
                                <h5 class="card-title">{{$asignado->nombre_corto}}</h5>
                                    <a class="btn btn-primary" onclick="verRespuestas( {{ $asignado->id }}, {{ $id }} )">Ver Respuestas</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Archivos') }}</div>
                        <div class="card w-60">
                            <div class="card-body" id='resultados'>


                                <h5 class="card-title" id='status' hidden>Entregado</h5>

                                    <div id='archivos_adjuntos'>

                                    </div>

                                    <a href="#" class="btn btn-primary mt-2" id='orden' hidden>Orden de Cambio</a>
                                    <a href="#" class="btn btn-primary" id='aceptar' hidden>Aceptar Respuesta</a>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    async function verRespuestas(grupoempresa_id, activity_id) {
        var hostname = window.location.host;

        console.log(grupoempresa_id);
        console.log(activity_id);


        var response = await fetch("http://" + hostname + "/api/adjunto/entrega/"+activity_id+"/" +grupoempresa_id);
        var json = await response.json();

        var contenedor = document.getElementById('archivos_adjuntos');
        contenedor.innerHTML='';

        json.forEach(element => {

            var archivo = document.createElement('a');
            archivo.setAttribute('href','http://' + hostname + '/' + element['path']);
            archivo.setAttribute('class','card-link');
            archivo.innerHTML = element['name']
            contenedor.appendChild(archivo);
            contenedor.appendChild(document.createElement('br'));
        });

        var ordenBtn = document.getElementById('orden');
        var aceptarBtn = document.getElementById('aceptar');

        ordenBtn.setAttribute('href' ,"http://" + hostname + "/verRespuestasDos/correccion/"+grupoempresa_id+"/" +activity_id);
        ordenBtn.hidden=false;
        // aceptarBtn.hidden=false;

        // document.getElementById('status').hidden = false;


    }
</script>
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
