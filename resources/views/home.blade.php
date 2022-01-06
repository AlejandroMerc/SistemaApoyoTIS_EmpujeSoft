@extends('layouts.home_layout')

@section('content')


<div class="containter-fluid">

    <br>
    <div class="col-md-12">
        @if ( $publications->isEmpty() )
            {{-- aqui poner bienvenida --}}
            <div class="row justify-content-center mt-5">
                <div class="col-auto">
                    <h1 class="text-muted">
                        Bienvenido
                    </h1>
                </div>
            </div>
        @else

            <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-publication-tab" data-toggle="pill" href="#pills-publication" role="tab" aria-controls="pills-publication" aria-selected="true">Publicaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-activity-tab" data-toggle="pill" href="#pills-activity" role="tab" aria-controls="pills-activity" aria-selected="false">Actividades</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-publication" role="tabpanel" aria-labelledby="pills-publication-tab">
                    @foreach ($publications as $publication)
                        @if ($publication->tipo=="Publicación")
                            <div class="card border border-secondary border-1 rounded-lg"  value={{$publication->id}}>
                                <div class="card-header border border-1 bg-opacity-10 bg-secondary text-white" style="opacity: .8;">
                                    <div class="row">
                                        <div class="col-11">
                                            <i class="fas fa-bullhorn text-white-30"></i>
                                            {{$publication->titulo_publicacion}}
                                        </div>
                                        @if ($user_type == 'asesor_tis')
                                            <div class="col-1">
                                                <a type="button" class="btn btn-warning" href="{{route('editPost',['publicacion_id' => $publication->id])}}">Editar</a>
                                            </div>

                                            <div class="col-1">
                                                <button type="button" class="btn bg-light" onclick="deleting( {{ $publication->id }} , 'Publicación', ' {{ $publication->titulo_publicacion }}')">
                                                    <i class="fa fa-trash text-dark fa-lg"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body  border border-1">

                                    <p class="card-text">{{$publication->descripcion_publicacion}}</p>
                                    @foreach($publication->adjuntos as $adjunto)
                                        <p><a href="{{asset($adjunto->path)}}" class="card-link"><i class="fas fa-paperclip"></i> {{$adjunto->name}}</a></p>
                                    @endforeach
                                </div>
                                <div class="card-footer text-muted border border-1 ">
                                    {{$publication->name}} {{$publication->lastname}} a las: {{$publication->fecha_publicacion}}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="tab-pane fade show" id="pills-activity" role="tabpanel" aria-labelledby="pills-activity-tab">
                    @foreach ($publications as $publication)
                        @if ($publication->tipo !=="Publicación")
                            <div class="card border border-secondary border-1 rounded-lg"  value={{$publication->id}}>
                                <div class="card-header border border-1 text-white bg-info">
                                    <div class="row">
                                        <div class="col-11">
                                            <i class="fas fa-tasks text-white-30"></i>
                                            {{$publication->titulo_publicacion}}
                                        </div>
                                        <div class="col-1">
                                            @if ($user_type == 'asesor_tis')
                                                <button type="button" class="btn bg-light"  onclick="deleting( {{ $publication->id }} , 'Actividad', '{{ $publication->titulo_publicacion }}')">
                                                    <i class="fa fa-trash text-dark fa-lg"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body  border border-1">

                                    <p class="card-text">{{$publication->descripcion_publicacion}}</p>
                                    @foreach($publication->adjuntos as $adjunto)
                                        <p><a href="{{asset($adjunto->path)}}" class="card-link"><i class="fas fa-paperclip"></i> {{$adjunto->name}}</a></p>
                                    @endforeach
                                    @if ($user_type == 'asesor_tis')
                                        <a href="{{route('verRespuestasDos',['publicacion_id' => $publication->id])}}" class="btn btn-primary">Ver Respuestas</a>
                                    @else
                                        <a href="{{route('responderActividad',['publicacion_id'=>$publication->id])}}" class="btn btn-primary">Responder</a>
                                    @endif
                                    <p class="card-text">Fecha de Entrega: {{$publication->fechaDeEntrega}}</p>
                                </div>
                                <div class="card-footer text-muted border border-1 ">
                                    {{$publication->name}} {{$publication->lastname}} a las: {{$publication->fecha_publicacion}}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- ventana de confirmación --}}
            <button id="modalBtn" type="button" data-toggle="modal" data-target="#modal" hidden>
            </button>

            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{route('postDestroy')}}" method="POST">
                        @csrf
                        <input id="idPublication" type="number" class="form-group" name="idPublication" value="" hidden>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitle"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="question">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <input type="submit" class="btn btn-danger" value="Eliminar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        @endif
    </div>

</div>


<script>
    function deleting( publication_id, title, name) {
        console.log('entrando funcion');
        var input_id = document.getElementById("idPublication");
        var modal_title = document.getElementById("modalTitle");
        var question = document.getElementById("question");
        input_id.value = publication_id;
        modal_title.innerHTML = 'Eliminar '+ title;
        question.innerHTML = '¿Desea eliminar la ' + title + ' ' + name + '?';

        console.log('modal aun no hizo click');
        document.getElementById('modalBtn').click();
        console.log('modal hizo click');
    }

</script>


@endsection
