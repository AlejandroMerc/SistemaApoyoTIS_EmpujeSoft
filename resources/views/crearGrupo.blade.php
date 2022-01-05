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
                <div class="card-header"><h1>Crear Grupo</h1></div>
                   <div class="card-body">
                    <form method="POST" >
                        @csrf
                        <div class="form-group row">
                         <label for="sigla" class="col-md-4 col-form-label text-md-right">{{ __('Sigla del Grupo ') }}</label>
                            <div class="col-md-6">
                                    <input id="sigla" type="text" class="form-control @error('sigla') is-invalid @enderror" name = "sigla" value="{{ old('sigla') }}" required autocomplete="sigla">
                                    @error('sigla')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                         <label for="docente" class="col-md-4 col-form-label text-md-right">{{ __('Docente') }}</label>
                             <div class="col-md-6">
                                    <select id="docente"  class="form-control @error('docente') is-invalid @enderror" name = "docente" value="{{ old('docente') }}" required autocomplete="docente">
                                    <option selected disabled value="">Docente...</option>
                                    @foreach($docentesArray as $docente)
                                    @if (old('docente') == $docente->id)
                                        <option value="{{ $docente->id }}" selected>{{ $docente->name }} {{ $docente->lastname }}</option>
                                    @else
                                        <option value="{{ $docente->id }}">{{ $docente->name }} {{ $docente->lastname }}</option>
                                    @endif

                                    @endforeach
                                </select>
                                    @error('docente')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="codigoInscripcion" class="col-md-4 col-form-label text-md-right">{{ __('Codigo inscripcion') }}</label>
                            <div class="col-md-6">
                                <input type="text" id="codigoInscripcion" class="form-control @error('codigoInscripcion') is-invalid @enderror" name="codigoInscripcion" value="{{ old('codigoInscripcion') }}"required>
                                @error('codigoInscripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="semestre" class="col-md-4 col-form-label text-md-right">{{ __('Semestre') }}</label>
                            <div class="col-md-6">
                                <select  id="semestre" class="form-control @error('semestre') is-invalid @enderror" name="semestre" value="{{ old('semestre') }}" required>
                                    <option selected disabled value="">Semestre...</option>
                                        @foreach($semestreArray as $semestre)
                                        @if (old('semestre') == $semestre ->id)
                                            <option value="{{ $semestre ->id }}" selected>{{ $semestre->periodo }}-{{ $semestre->year }}</option>
                                        @else
                                            <option value="{{ $semestre ->id }}">{{ $semestre->periodo }}-{{ $semestre->year }}</option>
                                        @endif

                                        @endforeach
                                </select>
                                @error('semestre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="crear" class="btn btn-primary">
                                    {{ __('Crear Grupo') }}
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


    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
    </script>
@endsection('content')
