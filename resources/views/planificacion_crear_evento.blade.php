@extends('layouts.app')



@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-standalone.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
<div class="container">
    <!-- Brand -->
    <div class="sidenav-header  align-items-center">
        <h1>Planificacion EmpujeSoft</h1>
    </div>
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">{{ __('Nuevo Evento') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('crearEvento-data') }}">
                              @csrf
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('*Nombre') }}</label>
                                            <div class="col-md-4">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                             </div>
                                    
                                        <label for="deathline" class="col-md-2 col-form-label text-md-right">{{ __('*Fecha') }}</label>
                                            <div class="col-md-3">                     
                                                <input type="datetime-local" id="deathline" class="form-control @error('deathline') is-invalid @enderror" name="deathline" required></input>
                                                    @error('deathline')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('*Descripción') }}</label>
                                            <div class="col-md-9">
                                                <textarea style="resize: none;" class="form-control @error('description') is-invalid @enderror" name="description" rows="5" id="description" required autofocus></textarea>
                                                    @error('description')                                                
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-9">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Agregar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>    
                </div>
              
                <div class="col-md-12">    
                    <div class="card">
                        <div class="card-header">{{ __('Entrega 1 Sprint') }}</div>
                            <div class="card w-20">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Descripción:') }}</label>
                                                <div class="col-md-4">
                                                    <h4>aaaaaaaaaaaaaaaaaaaaaasdsadsadsadas<h2>
                                                </div>
                                        
                                            <label for="deathline" class="col-md-2 col-form-label text-md-right">{{ __('Fecha') }}</label>
                                                <div class="col-md-3">                     
                                                     <h5>02/12/2021<h4>
                                                </div>
                                        </div>
                                    </div>    
                                </div>
                            </div>  
                        </div>    
                    </div>
                </div>
            </div>
       </div>
</div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"> </script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection