@extends('layouts.home_layout')

@section('content')
    <div class="p-2">
        <div class="d-flex justify-content-center"><span class="h2">Respuesta a la actividad</span></div>
        <div class="d-flex justify-content-center"><span>{{$grupoempresa}}</span></div>
    </div>

        <form method="post" action="" enctype="multipart/form-data">
        @csrf

        <ul class="nav nav-tabs" id="navegation" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="file-tab" data-toggle="tab" href="#file" role="tab" aria-controls="file" aria-selected="true">Subir archivo</a>
            </li>
            <li>
                <a class="nav-link" id="editor-tab" data-toggle="tab" href="#editor" role="tab" aria-controls="editor" aria-selected="false">Editor</a>
            </li>
        </ul>
        <div class="tab-content p-4" id="tabContent">
            {{-- Contenido para Subir Archivo --}}
            <div class="tab-pane fade show active" id="file" role="tabpanel" aria-labelledby="file-tab">
                <div class="file-drop-area">
                    <div class="mx-auto">
                        <span class="btn btn-primary">Escoger archivo</span>
                        <span class="file-message" id="textbox">O arrastre aqui el archivo</span>
                        <input class="file-input" type="file" id="file-upload" onchange="updateName()">
                    </div>
                </div>
            </div>
            {{-- Contenido para Editor --}}
            <div class="tab-pane fade" id="editor" role="tabpanel" aria-labelledby="editor-tab">
                <div class="d-flex">
                    <span>Plantilla: </span>
                    <select class="form-select ml-2" id="template-list" aria-label="Default select example" onchange="loadTemplate()">
                        <option value="0">Seleccionar plantilla</option>
                        @foreach ($template_content as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex">
                    <div class="card-body">
                        <div class="form-group">
                            <textarea class="ckeditor form-control" id="ckeditor" name="editor">{{ old('editor') }}</textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- boton enviar --}}
        <div class="d-flex flex-row-reverse pb-5 mr-5">
            <button type="submit" class="btn btn-outline-dark">Enviar</button>
        </div>
    </form>
    <link href="{{url('/css/drag_drop.css')}}" rel="stylesheet" type="text/css">
    <script>

        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
        function updateName() {
            var textbox = document.getElementById('textbox');
            var inputfile = document.getElementById('file-upload');
            var name = inputfile.value.split(/(\\|\/)/g).pop()
            textbox.innerHTML = name;
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
@endsection

@section('scripts')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.config.height = '30em';
    </script>
@endsection
