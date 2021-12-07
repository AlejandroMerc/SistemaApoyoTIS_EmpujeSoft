@extends('layouts.home_layout')

@section('content')


    <div class="container-sm border mt-3">
        <div class="row">
            <div class="col-sm-11 mt-3 mb-3">
                <div class="text-center">
                    <h3>Crear grupo de materia</h3>
                </div>
            </div>

        </div>
        <div class="row mx-auto">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 border">
                <form  method="POST" class="needs-validation" novalidate >
                    @csrf
                    <div class="form-row">
                      <div class="col-sm-4">
                        <label for="sigla" class="form-label">Sigla del grupo:</label>
                      </div>
                      <div class="col-sm-8">
                        <input id="sigla" type="text" name="sigla" class="form-control" value="{{ old('sigla') }}" placeholder="Sigla de grupo" required>
                        <div class="valid-feedback">

                        </div>
                        <p style="color:#ff0000">{{ $errors->first('sigla') }}</p>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="docente" class="form-label">Docente:</label>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group mt-3 mb-3">
                                <select id="docente" name="docente" class="form-select" value="{{ old('docente') }}" required>
                                    <option selected disabled value="">Docente...</option>
                                    @foreach($docentesArray as $docente)
                                    @if (old('docente') == $docente->id)
                                        <option value="{{ $docente->id }}" selected>{{ $docente->name }} {{ $docente->lastname }}</option>
                                    @else
                                        <option value="{{ $docente->id }}">{{ $docente->name }} {{ $docente->lastname }}</option>
                                    @endif

                                    @endforeach
                                </select>
                                <br>
                                <p style="color:#ff0000">{{ $errors->first('docente') }}</p>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="codigoInscricion" class="form-label">Codigo inscripcion:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="codigoInscripcion" placeholder="Codigo de inscripcion" name="codigoInscripcion" value="{{ old('codigoInscripcion') }}" required>

                            <p style="color:#ff0000">{{ $errors->first('codigoInscripcion') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="semestre" class="col-md-4 col-form-label text-md-right">Semestre</label>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group mt-3 mb-3">
                                <select id="semestre" name="semestre" class="form-select" value="{{ old('semestre') }}" required>
                                    <option selected disabled value="">Semestre...</option>
                                    @foreach($semestreArray as $semestre)
                                    @if (old('semestre') == $semestre ->id)
                                        <option value="{{ $semestre ->id }}" selected>{{ $semestre->periodo }}-{{ $semestre->year }}</option>
                                    @else
                                        <option value="{{ $semestre ->id }}">{{ $semestre->periodo }}-{{ $semestre->year }}</option>
                                    @endif

                                    @endforeach
                                </select>

                                <p style="color:#ff0000">{{ $errors->first('semestre') }}</p>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <button type="submit" id="crear" class="btn btn-primary">{{ __('Crear Grupo') }}</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
    </script>
@endsection('content')
