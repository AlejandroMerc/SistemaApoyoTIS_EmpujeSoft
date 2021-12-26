@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        
            <div class="card border border-dark">
                
                <div class="card-header bg-primary border border-dark">
                    <div class="row justify-content-center">  
                            <h3 class="text-bold text-white">{{$publicacion_a_Responder->titulo_publicacion}}</h3>
                    </div>
                </div>
               
                <br>
                <div class="card-body">
                    <div class="row ">
                        <div class="col-auto">
                            <h5 class=""><i class="fas fa-info-circle fa-fw" style="font-size:20px;color:rgb(89, 93, 102);"> </i> {{$publicacion_a_Responder->descripcion_publicacion}}</h5>

                        </div>
        
                    
                </div>    <br>
                <div class="row">
                    <div class="col-auto">
                        <h5>
                            <i class="fas fa-paperclip" style="font-size:20px;color:rgb(89, 93, 102);"></i> Archivos Adjuntos: 
                        </h5>
                    </div>
                   <div class="col-auto">
                    @if ($publicacion_a_Responder->adjuntos->isEmpty())
                        <h5> Ninguno</h5>
                    @endif
                    @foreach($publicacion_a_Responder->adjuntos as $adjunto)
                        <h5> <a href="{{asset($adjunto->path)}}" class="card-link">{{$adjunto->name}}</a></h5>
                @endforeach
                   </div>
                    
                </div>
                <br>
                <div class="row ">
                    <div class="col-md-6 col-sm-auto  border border-secondary   border-bottom-0">
                        <h5 class=""><i class="far fa-calendar fa-fw" style="font-size:20px;color:rgb(97, 102, 112);" ></i> <b>Fecha de Entrega</b> </h5>
                    </div>
                    <div class="col-md-6 col-sm-auto  border border-secondary border-left-0   border-bottom-0">
                       <h5> {{$actividad->fecha_fin_actividad}}</h5>
                    </div>
                      
                </div> 

                <div class="row ">
                    <div class="col-md-6 col-sm-auto border border-secondary  border-bottom-0">
                        <h5 class=""><i class="far fa-file" style="font-size:20px;color:rgb(97, 102, 112);"></i> <b> Formato permitido </b> </h5>
                    </div>
                    <div class="col-md-6 col-sm-auto border border-secondary border-left-0  border-bottom-0">
                        <h5 id=tipoID>{{$actividad->tipo_archivos_perm}}</h5>
                    </div>
                    
                </div>  

                <div class="row ">
                    <div class="col-md-6 col-sm-auto border border-secondary  ">
                        <h5 class=""><i class="far fa-folder" style="font-size:20px;color:rgb(97, 102, 112);"></i> <b> Cantidad de archivos permitidos</b> </h5>
                    </div>
                    <div class="col-md-6 col-sm-auto border border-secondary border-left-0  ">
                        <h5 id="cantidadId">{{$actividad->cantidad_archivos_perm}}</h5>
                    </div>
                  
                </div>      
                
                
                <br>
                
                
                <div class="container">
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                     <h5><i class="fas fa-file-upload" style="font-size:20px;color:rgb(97, 102, 112);"></i> Subir Archivos</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('sendActivity') }}"
                                    method="POST"
                                    class="dropzone"
                                    id="my-awesome-dropzone">
                                </form>
                                </div>
                            </div>
                            
            
                           
                            <script>
                                var tipoActividad=document.getElementById('tipoID').innerHTML;
                                var tipo="";
                                if(tipoActividad=="Documentos (pdf, docx, txt, pptx, xlsx)"){
                                    
                                    tipo="application/pdf,.doc,.docx,.xls,.xlsx,.txt,.ppt,.pptx";
                                }else{
                                    if(tipoActividad=="Imágenes (jpg, jpge, png, gif, bpm)"){
                                        tipo="image/jpeg, image/png, image/jpg, image/gif, image/bpm";
                                    }else{
                                        if(tipoActividad=="Comprimidos (zip, rar)"){
                                            
                                            tipo=".zip, .rar";
                                            
                                        }else{
                                            tipo="image/*, application/*, audio/*, .doc,.docx,.xls,.xlsx,.csv,.tsv,.ppt,.pptx,.pages,.odt,.rtf, .txt, .zip, .rar";
                                        }
                                    }
                                }
                                var cantidad=document.getElementById('cantidadId').innerHTML;
                               
                                Dropzone.options.myAwesomeDropzone = {
                                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                    accept: function(file, done) {
                                        
                                        var typeFile=file.name.split('.').pop();
                                        switch (typeFile) {
                                        
                                        case 'pdf':
                                            this.emit("thumbnail", file, "{{asset('images/pdf-icon.png')}}");            
                                            break;
                                        case 'doc':
                                            this.emit("thumbnail", file, "{{asset('images/Word-icon.png')}}");            
                                            break;
                                        case 'docx':
                                            this.emit("thumbnail", file, "{{asset('images/Word-icon.png')}}");            
                                            break;
                                        case 'xls':
                                            this.emit("thumbnail", file, "{{asset('images/Excel-icon.png')}}");            
                                            break;
                                        case 'xlsx':
                                            this.emit("thumbnail", file, "{{asset('images/Excel-icon.png')}}");            
                                            break;
                                        case 'ppt':
                                            this.emit("thumbnail", file, "{{asset('images/PowerPoint-icon.png')}}");            
                                            break;
                                        case 'pptx':
                                            this.emit("thumbnail", file, "{{asset('images/PowerPoint-icon.png')}}");            
                                            break;
                                        
                                        case 'txt':
                                            this.emit("thumbnail", file, "{{asset('images/txt-icon.png')}}");            
                                            break;
                                        case 'zip':
                                            this.emit("thumbnail", file, "{{asset('images/zip-icon.png')}}");            
                                            break;
                                        case 'rar':
                                            this.emit("thumbnail", file, "{{asset('images/rar-icon.png')}}");            
                                            break;
                                        }
                                        file.previewTemplate.querySelector(".dz-image img").style.width="120px";
                                        done();
                                    },
                                    dictDefaultMessage: "Arrastre un archivo al recuadro para subirlo",
                                    acceptedFiles: tipo,
                                    maxFilesize: 50,
                                    maxFiles: cantidad,
                                    addRemoveLinks: true,
                                    autoProcessQueue: false,
                                    dictRemoveFile: "Quitar Archivo",
                                    dictInvalidFileType: "No puedes subir este tipo de archivo" ,
                                    dictMaxFilesExceeded: "No puedes subir más archivos",
                                    
                                    removedfile: function(file) {
                                        var name = file.name;        
                                        $.ajax({
                                            type: 'POST',
                                            url: 'delete.php',
                                            data: "id="+name,
                                            dataType: 'html'
                                        });
                                    var _ref;
                                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
                                                },
                                               
                                };
        
                                
                            </script>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group row mb-0 justify-content-center">
                    <div class="col-md-6 offset-md-4 ">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Enviar') }}
                        </button>
                    </div>
                </div>
                </div>
                
            </div>
                
        
        </div>
    </div>
</div>
    
@endsection