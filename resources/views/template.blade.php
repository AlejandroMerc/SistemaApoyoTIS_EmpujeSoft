@extends('layouts.home_layout')

@section('content')
    {{-- Title & add button --}}
    <div class="d-flex mx-2 row">
        {{-- <div class="row"> --}}
            <div class="col-10 my-auto">
                <div>
                    <span class="h4">
                        Plantillas
                    </span>
                </div>
            </div>
            <div class="btn col-auto" style="z-index: 10">
                <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                    <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <h5>
                                Crear  <i class="far fa-plus-square text-primary ml-2" style="font-size:24px;color:black;"></i>
                            </h5>

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
            <div class="col-auto my-auto">
                <a class="rounded-pill bg-secondary p-2" type="button" onclick="showinfo()">
                    <span class="h5">
                        <i class="fas fa-question text-white"></i>
                    </span>
                </a>
            </div>
        {{-- </div> --}}
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
        {{-- <div class="container-fluid list-group">
        @foreach ($template_list as $template)
            <a href="{{ route('template-editor-id', ['id' => $template->id]) }}" role="button" class="list-group-item list-group-item-action">{{ $template->nombre }}</a>
            <button class="btn btn-default btn-xs pull-right remove-item">
                <span class="glyphicon glyphicon-remove"></span>
            </button>
        @endforeach
        </div> --}}

        <div class="container-fluid">
            @foreach ($template_list as $template)
                    <div class="container-fluid d-flex">
                        <div class="d-flex" style="width: 100%; max-width: 100%;">
                            <a href="{{ route('template-editor-id', ['id' => $template->id]) }}" role="button" class="list-group-item list-group-item-action">{{ $template->nombre }}</a>
                        </div>
                        <div class="ml-auto d-inline-flex">
                            <button class="btn" onclick="deleteTemplate( {{ $template->id }} )">
                               <h3><i class="far fa-times-circle text-danger"></i>
                                   </h3>
                            </button>
                        </div>
                    </div>
            @endforeach
        </div>
    @endif

    {{-- fin lista --}}

    <script>
        async function deleteTemplate(templateId) {
            try{
                var hostname = window.location.host;
                var response = await fetch("http://" + hostname + "/api/template/delete/" +templateId);
                if (response) {
                    location.reload();
                }
            } catch (error) {
                error;
                console.log(error);
            }
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

        function showinfo() {
            var msg = "Bienvenido!\n"+
            "Esta es la sección de plantillas. En este apartado se le permite crear, editar y eliminar plantillas.\n"+
            "¿Que son las plantillas?\n"+
            "Una plantilla es un tipo de documento que crea una copia de sí mismo cuando se usa, para evitar "+
            "estar escribiendo la estructura del documento desde cero."+
            " Se desea recalcar que las plantillas se usan como BASE PARA NO ESTAR CREANDO DOCUMENTOS DESDE CERO y NO SON DOCUMENTOS LISTOS para enviar.\n"+
            "El apartado para usar plantillas es al momento de crear una actividad usando el editor "+
            "que viene integrado. Una vez seleccionado la plantilla, usted puede modificar como guste "+
            "sin preocuparse de que la plantilla se vaya a modificar.\n"+
            "Tambien se desea recalcar que todos los asesores comparten las mismas plantillas, por lo cual, "+
            "antes de modificar una plantilla considere que los demas asesores podrian estar usando esa plantilla. "+
            "Se recomienda crear nuevas plantillas para estos casos.";
            swal('¿Que hago aqui?', msg,'info', {button: 'cerrar'});
        }
    </script>
@endsection
