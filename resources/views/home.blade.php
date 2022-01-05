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
            @foreach ($publications as $publication)
                <div class="card border border-secondary border-1 rounded-lg"  value={{$publication->id}}>
                    @if ($publication->tipo=="Publicación")
                        <div class="card-header border border-1 bg-opacity-10 bg-secondary text-white" style="opacity: .8;">
                            <i class="fas fa-bullhorn text-white-30"></i>
                            {{$publication->titulo_publicacion}}
                        </div>
                    @else
                        <div class="card-header border border-1 text-white bg-info">
                            <i class="fas fa-tasks text-white-30"></i>
                            {{$publication->titulo_publicacion}}
                        </div>
                    @endif

                <div class="card-body  border border-1">

                <p class="card-text">{{$publication->descripcion_publicacion}}</p>
                @foreach($publication->adjuntos as $adjunto)
                    <p><a href="{{asset($adjunto->path)}}" class="card-link"><i class="fas fa-paperclip"></i> {{$adjunto->name}}</a></p>
                @endforeach
                @if ($publication->tipo=="Actividad")
                    @if ($user_type == 'asesor_tis')
                        <a href="{{route('verRespuestasDos',['publicacion_id' => $publication->id])}}" class="btn btn-primary">Ver Respuestas</a>
                    @else
                        <a href="{{route('responderActividad',['publicacion_id'=>$publication->id])}}" class="btn btn-primary">Responder</a>
                    @endif
                    <p class="card-text">Fecha de Entrega: {{$publication->fechaDeEntrega}}</p>
                @endif
                </div>
                <div class="card-footer text-muted border border-1 ">
                    {{$publication->name}} {{$publication->lastname}} a las: {{$publication->fecha_publicacion}}
                </div>
            </div>

        @endforeach
    @endif
    </div>

</div>
<script>
var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
</script>
@endsection
