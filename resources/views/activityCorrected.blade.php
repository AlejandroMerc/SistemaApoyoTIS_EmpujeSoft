@extends('layouts.home_layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-dark rounded-lg">
                <div class="card-header bg-primary text-white"><strong><h5 class="text-white"> Orden de Cambio</h5></div>

                <div class="card-body ">
                    <form method="POST" action="{{ route('verRespuesta.correccion', ['id_grupoempresa' => $id_grupoempresa, 'id_activity'=>$id_activity]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('*Título') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', 'Corrección de '.$activity) }}" required autocomplete="title" autofocus>

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

                                <textarea style="resize: none;" class="form-control @error('description') is-invalid @enderror" name="description" rows="5" id="description" required autofocus></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="uploadFiles" class="col-md-4 col-form-label text-md-right">{{ __('Adjuntar Archivos') }}</label>

                            <div class="col-md-6">
                                <div class="input-group hdtuto control-group lst increment" >
                                    <input type="file" name="filenames[]" class="myfrm form-control">
                                    <div class="input-group-btn">
                                      <button class="btn btn-outline-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Agregar</button>
                                    </div>
                                  </div>
                                  <div class="clone hide" hidden>
                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                      <input type="file" name="filenames[]" class="myfrm form-control">
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
                                {{-- parte plantilla --}}
                                <div class="mt-2">
                                    <input type="checkbox" id="cbxEditor" name="cbxEditor" value="cbxEditor" style="display: none" {{ (old('cbxEditor') !== null)? 'checked' : '' }}>

                                    <button class="btn btn-outline-primary btn-block" id='templateAddBtn' type="button" onclick="template()">
                                        Crear con editor
                                    </button>

                                    <button class="btn btn-outline-primary" id='templateBtn' type="button" data-toggle="modal" data-target=".bd-example-modal-lg" hidden>
                                        Archivo desde editor
                                    </button>
                                    <button class="btn btn-danger" id='deleteBtn' type="button" onclick="deleteTemplate()" hidden>
                                        Eliminar
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-lg" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <div class="d-flex">
                                                    <span>Plantilla: </span>
                                                    <select class="form-select ml-2" id="template-list" aria-label="Default select example" onchange="loadTemplate()">
                                                        <option value="0">Seleccionar plantilla</option>
                                                        @foreach ($template_content as $id => $name)
                                                            <option value="{{$id}}">{{$name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="d-flex">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <textarea class="ckeditor form-control" id="ckeditor" name="editor">{{ old('editor') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Fin parte plantilla --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="toWhom" class="col-md-4 col-form-label text-md-right">{{ __('Para') }}</label>

                            <div class="col-md-6">
                                <input id="toWhom" type="text" class="form-control" name="toWhom" value="Grupo Empresa: {{ $grupoempresa}}" required readonly>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deathline" class="col-md-4 col-form-label text-md-right">{{ __('*Fecha de Entrega') }}</label>

                            <div class="col-md-6">
                                <input type="datetime-local" id="deathline" class="form-control @error('deathline') is-invalid @enderror" name="deathline" required>

                                @error('deathline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cantFilesMax" class="col-md-4 col-form-label text-md-right">{{ __('*Cant. de archivos permitidos') }}</label>

                            <div class="col-md-6">
                                <input type="number" id="cantFilesMax" class="form-control @error('cantFilesMax') is-invalid @enderror" value="{{ $lastMaxFiles }}" name="cantFilesMax" min="1" max="10">

                                @error('cantFilesMax')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="typeFiles" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de archivos permitidos') }}</label>

                            <div class="col-md-6">

                                <select id="typeFiles"  class="form-control @error('typeFiles') is-invalid @enderror" name="typeFiles" value="{{ $lastTypeFiles }}">
                                    <option value="anything">Cualquiera</option>
                                    <option value="docs">Documentos (pdf, docx, txt, pptx, xlsx)</option>
                                    <option value="images">Imágenes (jpg, jpge, png, gif, bpm)</option>
                                    <option value="compress">Comprimidos (zip, rar)</option>

                                </select>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Publicar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.config.height = '30em';

    function template() {
        var buttonModal = document.getElementById('templateBtn');
        document.getElementById('templateAddBtn').hidden = true;
        document.getElementById('deleteBtn').hidden = false;
        document.getElementById('cbxEditor').checked = true;
        buttonModal.hidden = false;
        buttonModal.click()
    }

    function deleteTemplate() {
        document.getElementById('templateBtn').hidden = true;
        document.getElementById('templateAddBtn').hidden = false;
        document.getElementById('deleteBtn').hidden = true;
        document.getElementById('template-list').value = 0;
        document.getElementById('cbxEditor').checked = false;
        CKEDITOR.instances.ckeditor.setData('');
    }

    async function loadTemplate() {
        var editor = document.getElementById('ckeditor');
        var selected = document.getElementById('template-list').value;
        if (selected !== 0){
            try{
                var hostname = window.location.host;
                var response = await fetch("http://" + hostname + "/api/template/" +selected);
                var json = await response.json();
                CKEDITOR.instances.ckeditor.setData(json.html_code);
            } catch (error) {
                error;
                console.log(error);
            }
        }
    }
</script>
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

@endsection
