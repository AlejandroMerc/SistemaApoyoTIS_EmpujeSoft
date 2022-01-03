@extends('layouts.home_layout')

@section('content')

    <div class="p-2">
        <div class="d-flex justify-content-center"><span class="h2">Respuesta a la actividad {{$activity}}</span></div>
        <div class="d-flex justify-content-center"><span>Grupo empresa {{$grupoempresa}}</span></div>
    </div>

        @error('editor')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}!</strong>
            </span>
        @enderror
        @error('file')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}!</strong>
            </span>
        @enderror


        <form method="post" action="{{ route('verRespuesta.revision', ['id_grupoempresa' => $id_grupoempresa, 'id_activity'=>$id_activity]) }}" enctype="multipart/form-data">
        @csrf

            <input type="checkbox" id="save" name="save" value="save" style="display: none">
            <input type="checkbox" id="cbxEditor" name="cbxEditor" value="cbxEditor" style="display: none" {{ (old('cbxEditor') !== null)? 'checked' : '' }}>
            <ul class="nav nav-tabs" id="navegation" role="tablist">
                <li class="nav-item">
                    <a class="nav-link @if( old('cbxEditor') === null ) active @endif" id="file-tab" data-toggle="tab" href="#file" role="tab" aria-controls="file" aria-selected="{{ (old('cbxEditor') !== null)? false : true }}" onclick="isEditorSelected(false)">Subir archivo</a>
                </li>
                <li>
                    <a class="nav-link @if( old('cbxEditor') !== null ) active @endif" id="editor-tab" data-toggle="tab" href="#editor" role="tab" aria-controls="editor" aria-selected="{{ (old('cbxEditor') === null)? false : true }}" onclick="isEditorSelected(true)">Editor</a>
                </li>
            </ul>
            <div class="tab-content p-4" id="tabContent">
                {{-- Contenido para Subir Archivo --}}
                <div class="tab-pane fade @if( old('cbxEditor') === null ) show active @endif" id="file" role="tabpanel" aria-labelledby="file-tab">
                    <div class="file-drop-area">
                        <div class="mx-auto">
                            <span class="btn btn-primary">Escoger archivo</span>
                            <span class="file-message" id="textbox">O arrastre aqui el archivo</span>
                            <input class="file-input" type="file" id="file-upload" name="file" onchange="updateName()">
                        </div>
                    </div>
                </div>
                {{-- Contenido para Editor --}}
                <div class="tab-pane fade @if( old('cbxEditor') !== null ) show active @endif" id="editor" role="tabpanel" aria-labelledby="editor-tab">
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
                <button type="button" class="btn btn-outline-dark" onclick="saveState()">Guardar estado</button>
                <button type="button" class="btn btn-outline-dark" onclick="sendData()">Enviar</button>
                <button type="submit" class="btn btn-outline-dark" id="submit" style="display: none"></button>
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

        function isEditorSelected(value) {
            document.getElementById('cbxEditor').checked = value;
        }

        function saveState() {
            document.getElementById('save').checked = true;
            document.getElementById('submit').click();
        }

        function sendData() {
            document.getElementById('save').checked = false;
            document.getElementById('submit').click();
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
