@extends('layouts.home_layout')

@section('content')
    {{-- Title & add button --}}
    <div class="d-flex mx-2">
        <div class="my-auto">
            <div>Plantillas</div>
        </div>
        <div class="btn ml-auto">
            <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <i class="fas fa-plus-circle" style="font-size:24px;color:black;"></i>
                    </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right ">
                    <a href="{{ url('/plantillas/editor') }}" method="get" class="dropdown-item">
                        <i class="fas fa-file-medical"></i>
                        <span>Nuevo</span>
                    </a>
                    {{-- <a href="{{ url('/plantillas/subir') }}" method="get" class="dropdown-item"> --}}
                    <button class="dropdown-item" onclick="loaddocfile()">
                        <form id="formfile" action="{{ route("template-upload") }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <i class="fas fa-file-export"></i>
                            <label for="docfile">Subir</label>
                            <input type="file" id="docfile" name="docfile" style="display:none;" accept=".docx" onchange="uploadingFile(this)">
                        </form>
                    </button>
                    {{-- </a> --}}
                </div>
                </li>
            </ul>
        </div>
    </div>
    <hr class="my-2">
    {{-- Lista --}}


    <script>
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
