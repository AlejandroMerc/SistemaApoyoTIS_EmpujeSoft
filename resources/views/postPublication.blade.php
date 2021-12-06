@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-dark rounded-lg">
                <div class="card-header bg-primary text-white"><strong><h5>{{ __('Nueva Publicación') }}</h5></div>

                <div class="card-body ">
                    <form method="POST" action="{{ route('register-publication') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('*Título') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

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
                        
                                <textarea style="resize: none;" class="form-control @error('description') is-invalid @enderror" name="description" rows="5" id="description" value="{{ old('description') }}" required autofocus></textarea>
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

                            <label for="uploadFiles" class="col-md-4 col-form-label text-md-right">{{ __('Adjuntar Archivos') }}</label>
                            <div class="col-md-6">
                                <div class="input-group hdtuto control-group lst increment" >
                                    <input type="file" name="filenames[]" class="myfrm form-control @error('filenames') is-invalid @enderror" id="filenames">
                                    @error('filenames')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    <div class="input-group-btn"> 
                                      <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                                    </div>
                                  </div>
                                  <div class="clone hide">
                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                      <input type="file" name="filenames[]" class="myfrm form-control @error('filenames') is-invalid @enderror" id="filenames">
                                      @error('filenames')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                      <div class="input-group-btn"> 
                                        <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
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

@endsection

