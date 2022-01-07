@extends('layouts.home_layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-dark rounded-lg">
                <div class="card-header bg-primary text-white"><strong><h5 class="text-white"><b> {{ __('Editar Publicación') }}</b></h5></div>

                <div class="card-body ">
                    <form method="POST" action="{{ route('update-publication') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('*Título') }}</label>
                            <input type="number" name="idPost" value="{{$publication->id}}" hidden>
                            <div class="col-md-6">
                                <input id="title" type="text" value="{{$publication->titulo_publicacion}}" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus placeholder="Título Publicación">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('*Descripción') }}</label>

                            <div class="col-md-6">

                                <textarea style="resize: none;"  class="form-control @error('description') is-invalid @enderror" name="description" rows="5" id="description"  required autofocus placeholder="Descripción Publicación">{{$publication->descripcion_publicacion}}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="toWhom" class="col-md-4 col-form-label text-md-right">{{ __('Para') }}</label>

                            <div class="col-md-6">

                                <select id="toWhom"  class="form-control @error('toWhom') is-invalid @enderror" name="toWhom">
                                    <option value="everybody">Todos</option>

                                    @foreach ($grupos as $grupo)
                                    <option value='grupo, {{$grupo->id}}'>Grupo:  {{$grupo->sigla_grupo}}</option>
                                    @endforeach

                                    @foreach ($grupoEmpresas as $grupoEmpresa)
                                    <option value='grupoEmpresa, {{$grupoEmpresa->id}}'>GrupoEmpresa:  {{$grupoEmpresa->nombre_corto}}</option>
                                    @endforeach

                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="msg" class="col-md-4 col-form-label text-md-right">{{ __('Archivos Existentes') }}</label>
                            
                               
                                  
                        
                             
                            
                            <ul class="list-group pl-3">
                                
                            @foreach($publication->adjuntos as $adjunto)   
                            
                                  
                            <div class="con" id="{{$adjunto->id}}" style="margin-top:10px">        
                                    <li class="list-group-item"><a  href="{{asset($adjunto->path)}}" class="card-link">{{$adjunto->name}}</a> <button type="button" class="btn btn-outline-danger rounded-circle" onclick="borrarAdjunto('{{$adjunto->id}}')" ><i class="fas fa-times text-danger"></i></button></li>
                                    <input type="number" name="adjuntos[]"  value="{{$adjunto->id}}" hidden>
                            </div>
                            @endforeach
                             </ul>
                             @if ($publication->adjuntos->isEmpty())
                             <h6 id="msg" class="text-primary pt-2 pl-3"> <b> No existen archivos</b> </h6>
                             @endif
                             <h6 id="msg" class="text-primary pt-2 pl-3" hidden> <b> No existen archivos</b> </h6>
                        </div>

                        

                        <div class="form-group row">
 
                            <label for="uploadFiles" class="col-md-4 col-form-label text-md-right">{{ __('Adjuntar Nuevos Archivos') }}</label>
                            <div class="col-md-6">
                                <div class="input-group hdtuto control-group lst increment" >
                                    <input type="file" name="filenames[]" class="myfrm form-control @error('filenames') is-invalid @enderror" id="filenames">
                                    @error('filenames')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    <div class="input-group-btn">
                                      <button class="btn btn-outline-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Agregar</button>
                                    </div>
                                  </div>
                                
                                 <div class="clone hide" hidden>
                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                      <input type="file" name="filenames[]" class="myfrm form-control @error('filenames') is-invalid @enderror" id="filenames">
                                      @error('filenames')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                      <div class="input-group-btn">
                                        <button class="btn btn-outline-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Quitar</button>
                                      </div>
                                    </div>
                                  </div>

                                    @if (count($errors) > 0)




                                        @foreach ($errors->all() as $error)
                                           @if ($error=="Los archivos adjuntos deben de ser de formato: jpg, jpge, gif, png, xls, xlsx, doc, docx, pdf, zip, rar")
                                           <br>
                                           <div class="alert alert-danger">
                                              {{ $error }}
                                           </div>

                                           @endif

                                        @endforeach


                                    @endif
                            </div>


                        </div>



                        <div class="form-group row justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                            <div class="col-auto">
                                <a type="button" class="btn btn-secondary text-white" href="{{route('home')}}">
                                    {{ __('Cancelar') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
      $(".btn-outline-success").click(function(){
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
          lsthmtl.hidden =false;
      });
      $("body").on("click",".btn-outline-danger",function(){
          $(this).parents(".hdtuto").remove();
      });
      
    });
</script>

<script type="text/javascript">
     function borrarAdjunto(idAdjunto){
        swal({
            
            text: "¿Está seguro de Eliminar el Archivo?",
            icon: "warning",
            buttons: ["Cancelar","Aceptar"],
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                var el = document.getElementById( idAdjunto );
                el.parentNode.removeChild( el );
                console.log(document.getElementsByClassName('con'));
                if(document.getElementsByClassName('con').length===0){
                    document.getElementById('msg').hidden=false;
                }
                swal("Archivo Eliminado", {
                icon: "success",
                });
            } else {
                swal("El archivo no se eliminó", {
                icon: "error",
                });
            }
            });
        

      
     }
</script>

@endsection

