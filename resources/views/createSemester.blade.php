@extends('layouts.home_layout')

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
                <div class="card-header bg-primary text-white"><strong><h4>Crear Semestre</h4></div>
                   <div class="card-body">
                    <form method="POST" action="{{ route('store-data') }}">
                        @csrf
                        <div class="form-group row">
                         <label for="telefono_ge" class="col-md-4 col-form-label text-md-right">{{ __('Año ') }}</label>
                            <div class="col-md-6">
                                    <input id="anio" type="number" class="form-control @error('anio') is-invalid @enderror" name = "anio" value="{{ old('anio', $current_year) }}" required autocomplete="anio">
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
                                    <input id="periodo" type="number" class="form-control @error('periodo') is-invalid @enderror" name = "periodo" value="{{ old('periodo', 1) }}" required autocomplete="periodo">
                                    @error('periodo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="FechaInicio" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Inicial') }}</label>
                            <div class="col-md-6">
                                <input type="datetime-local" id="FechaInicio" class="form-control @error('FechaInicio') is-invalid @enderror" name="FechaInicio" min="{{$current_year}}-01-01T00:00" max="{{$current_year+1}}-12-31T23:59" value="{{ old('FechaInicio', $current_year.'-01-01T00:00') }}" required>
                                @error('FechaInicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="FechaFin" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Final') }}</label>
                            <div class="col-md-6">

                                <input type="datetime-local" id="FechaFin" class="form-control @error('FechaFin') is-invalid @enderror" name="FechaFin" min="{{$current_year}}-01-01T00:00" max="{{$current_year+1}}-12-31T23:59" value="{{ old('FechaFin',$current_year.'-01-01T23:59') }}" required>
                                @error('FechaFin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
</div>
<script>
     var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
</script>
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
