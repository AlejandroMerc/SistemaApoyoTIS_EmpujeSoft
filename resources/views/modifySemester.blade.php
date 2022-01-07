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
                <div class="card-header bg-primary text-white d-flex justify-content-between">
                    <span style="color:white"class="h4">@if ($started) Modificar Semestre @else Semestre pendiente @endif {{ $semester->year }}/{{ $semester->periodo }}</span>
                    <a class="rounded-pill bg-secondary p-2" type="button" onclick="showAlert(@if($started)true @else false @endif)">
                        <span class="h6">
                            <i class="fas fa-question text-white"></i>
                        </span>
                    </a>
                </div>
                   <div class="card-body"><strong>
                    <form method="POST" action="@if ($started){{route('semestre.modif-start-data')}}@else{{route('semestre.modif-data')}}@endif">
                        @csrf
                        <input hidden type="number" name="semester_id" value={{$semester->id}}>

                        <div class="form-group row">
                         <label for="telefono_ge" class="col-md-4 col-form-label text-md-right">{{ __('*Año ') }}</label>
                            <div class="col-md-6">
                                    <input @if( $started) disabled @endif id="anio" type="number" class="form-control @error('anio') is-invalid @enderror" name = "anio" value="{{ old('anio', $semester->year) }}" required autocomplete="anio">
                                    @error('anio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                         <label for="periodo" class="col-md-4 col-form-label text-md-right">{{ __('*Periodo') }}</label>
                             <div class="col-md-6">
                                    <input @if( $started) disabled @endif id="periodo" type="number" class="form-control @error('periodo') is-invalid @enderror" name = "periodo" value="{{ old('periodo', $semester->periodo) }}" required autocomplete="periodo">
                                    @error('periodo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="FechaInicio" class="col-md-4 col-form-label text-md-right">{{ __('*Fecha Inicial') }}</label>
                            <div class="col-md-6">
                                <input @if( $started) disabled @endif type="datetime-local" id="FechaInicio" class="form-control @error('FechaInicio') is-invalid @enderror" name="FechaInicio" min="{{$current_year}}-01-01T00:00" max="{{$current_year+1}}-12-31T23:59" value="{{ old('FechaInicio', $semester->fecha_inicio.'T00:00') }}" required>
                                @error('FechaInicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="FechaFin" class="col-md-4 col-form-label text-md-right">{{ __('*Fecha Final') }}</label>
                            <div class="col-md-6">

                                <input type="datetime-local" id="FechaFin" class="form-control @error('FechaFin') is-invalid @enderror" name="FechaFin" min="@if($started){{ __($today.'T00:00')}}@else{{ __(($current_year)."-01-01T00:00")}}@endif" max="@if($started){{$semester->year+1}}@else{{$current_year+1}}@endif-12-31T23:59" value="{{ old('FechaFin',$semester->fecha_fin.'T00:00') }}" required>
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
                                    {{ __('Modificar Semestre '.$semester->year.'/'.$semester->periodo) }}
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

@endsection

@section('script-body')
    <script>
        function showAlert(started) {
            var msg;
            if (started) {
                msg = 'Existe un semestre que está en proceso.\nMientras este semestre esté en proceso, lo único que se puede modificar es la fecha de finalizacion.';
            } else {
                msg = 'Existe un semestre creado que aun no empezó.\nMientras este semestre no empiece, usted puede modificar cualquiera de los campos, pero una vez empiece el semestre, solo podrá modificar la fecha final';
            }
            swal('¿Que sucede?', msg,'info', {button: 'cerrar'});
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
