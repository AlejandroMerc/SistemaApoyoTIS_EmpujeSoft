@extends('layouts.home_layout')

@section('content')
    {{-- Title & add button --}}
    <div class="d-flex mx-2">
        <div class="my-auto">
            <div>Plantillas</div>
        </div>
        <div class="btn ml-auto" style="z-index: 10">
            <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <i class="fas fa-plus-circle" style="font-size:24px;color:black;"></i>
                    </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right ">
                    <a href="{{ route('template-editor-id',['id'=>-1]) }}" method="get" class="dropdown-item">
                        <i class="fas fa-file-medical"></i>
                        <span>Nuevo</span>
                    </a>
                    <button class="dropdown-item" onclick="loaddocfile()">
                        <form id="formfile" action="{{ route("template") }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <i class="fas fa-file-export"></i>
                            <label for="docfile">Subir</label>
                            <input type="file" id="docfile" name="docfile" style="display:none;" accept=".docx" onchange="uploadingFile(this)">
                        </form>
                    </button>
                </div>
                </li>
            </ul>
        </div>
    </div>
    <hr class="my-2">
    {{-- Lista --}}
    @if ( empty($template_list) )
        <div class="d-flex align-items-center" style="min-height: 50vh">
        <div class="container-fluid">
            <p class="text-gray text-center">No hay plantillas</p>
        </div>
        </div>
    @else
        <div class="container-fluid list-group">
        @foreach ($template_list as $template)
            <a href="{{ route('template-editor-id', ['id' => $template->id]) }}" role="button" class="list-group-item list-group-item-action">{{ $template->nombre }}</a>
        @endforeach
        </div>
    @endif

    {{-- fin lista --}}
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }

        function uploadingFile(oInput) {
            if (oInput.type == "file") {
                var fileName = oInput.value;
                var length = fileName.length;
                var isValid = false;
                if (length > 0) {
                    var dot = fileName.lastIndexOf(".");
                    if (dot > 0) {
                        var extension = fileName.substring(dot,length);
                        if (extension === ".docx") {
                            isValid = true;
                            document.getElementById('formfile').submit();
                            return true;
                        }
                    }

                    if (!isValid) {
                        alert("El archivo " + fileName + " no es de una extension valida.\nPor favor seleccione un archivo de extension .docx");
                        oInput.value = "";
                        return false;
                    }
                }
            }
        }

        function loaddocfile() {
            document.getElementById("docfile").click();
        }
    </script>
@endsection