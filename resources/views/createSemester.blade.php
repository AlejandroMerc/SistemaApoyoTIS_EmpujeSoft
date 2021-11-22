@extends('layouts.listGEmpresa')



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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Crear Semestre') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register-ge-data') }}">
                        @csrf
                        <div class="form-group row">    
                        <label for="telefono_ge" class="col-md-4 col-form-label text-md-right">{{ __('Año ') }}</label>
                            <div class="col-md-6">                               
                                    <input id="anio" type="number" class="form-control @error('anio') is-invalid @enderror" min="19000000" max="99999999" name = "anio" value="{{ old('anio') }}" required autocomplete="anio">
                                    @error('anio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">    
                        <label for="periodo" class="col-md-4 col-form-label text-md-right">{{ __('Periodo') }}</label>
                            <div class="col-md-6">                               
                                    <input id="periodo" type="number" class="form-control @error('periodo') is-invalid @enderror" min="19000000" max="99999999" name = "periodo" value="{{ old('periodo') }}" required autocomplete="periodo">
                                    @error('periodo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="published_at" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Inicial') }}</label> 
                            <div class="col-md-6">    
                                <input type="text" class="form-control" id="published_at" name = "published_at" value="{{ old('published_at') }}" required autocomplete="published_at">
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="published_at2" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Final') }}</label> 
                            <div class="col-md-6">    
                                <input type="text" class="form-control" id="published_at2" name = "published_at2" value="{{ old('published_at2') }}" required autocomplete="published_at2">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Crear Semestre') }}
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

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"> </script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at')
        flatpickr('#published_at2')
    </script>
@endsection