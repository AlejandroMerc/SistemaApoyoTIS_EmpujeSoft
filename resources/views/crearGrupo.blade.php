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
    @if ( $haySemestre)
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-header"><span class="h3">{{ __('Grupos') }}</span></div>
                <div class="list-group">
                    {{-- <a id='0' role="button" class="list-group-item list-group-item-action active" onclick="loadData(0)">Nuevo grupo</a> --}}
                    <div class="d-flex">
                        <div class="d-flex" style="width: 100%; max-width: 100%;">
                            <a id='0' role="button" class="list-group-item list-group-item-action active" onclick="loadData(0)">
                                <div class="d-flex justify-content-between">
                                    <span class="h5 my-auto">
                                        Nuevo grupo
                                    </span>
                                    <span class="h3 my-auto"><i class="far fa-plus-square"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @foreach ($grupos as $grupo)
                        {{-- <a id='{{$grupo->id}}' role="button" class="list-group-item list-group-item-action" onclick="loadData({{$grupo->id}})">{{$grupo->sigla_grupo}} - {{ $asesores[$grupo->asesor_id] }}</a> --}}
                        <div class="d-flex">
                            <div class="d-flex" style="width: 100%; max-width: 100%;">
                                <a id='{{$grupo->id}}' role="button" class="list-group-item list-group-item-action" onclick="loadData({{$grupo->id}})">{{$grupo->sigla_grupo}} - {{ $asesores[$grupo->asesor_id] }}</a>
                            </div>
                            <div class="ml-auto d-inline-flex">
                                <button class="btn" onclick="deleteGroup({{$grupo->id}})">
                                   <h3><i class="far fa-times-circle text-danger"></i>
                                       </h3>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
    <div class="row justify-content-center">
    @endif
        <div class="col-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span id='title' class="h1">Crear Grupo</span>
                    @if ( !$haySemestre )
                        <a class="rounded-circle p-2 bg-red" type="button" onclick="showalert()">
                            <span class="h2">
                                <i class="fas fa-exclamation-triangle text-yellow"></i>
                            </span>
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    <form method="POST" >
                        @csrf
                        <input hidden type="number" id="selected_id" name="group_id" value="0">
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
                                    <option selected disabled value="default">Docente...</option>
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
                                @if ( $haySemestre)
                                <input type="number" id="semestre" name="semestre" value="{{$semestre->id}}" hidden>
                                @endif
                                <input type="text" id="semestre-name" class="form-control @if( !$haySemestre )is-invalid @endif" name="semestre-name" value="@if( !$haySemestre )Semestre...@else{{$semestre->periodo}}-{{$semestre->year}}@endif" disabled>

                                @if ( !$haySemestre )
                                    <span class="invalid-feedback" role="alert">
                                        <strong>No hay un semestre activo o pendiente</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button @if(!$haySemestre) disabled @endif type="submit" id="crear" class="btn btn-primary">
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
@endsection('content')
@section('script-body')
<script>
    async function loadData(selected) {

        var groupSelected = document.getElementById('selected_id');

        if (selected !== groupSelected) {
            // swal('Cargando','Espere por favor','info',{});
            var lastSelected = document.getElementById(groupSelected.value);;
            var newSelected = document.getElementById(selected);
            lastSelected.classList.remove('active');
            newSelected.classList.add('active');
            groupSelected.value = selected;
            if (selected == 0) {
                document.getElementById('title').innerHTML = 'Crear Grupo';
                document.getElementById('sigla').value = '';
                document.getElementById('docente').value = 'default';
                document.getElementById('codigoInscripcion').value = '';
                document.getElementById('crear').innerHTML = 'Crear Grupo';
            } else {
                var hostname = window.location.host;
                var response = await fetch("http://" + hostname + "/api/grupos/" +selected);
                var json = await response.json();

                document.getElementById('title').innerHTML = 'Modificar Grupo';
                document.getElementById('sigla').value = json.sigla_grupo;
                document.getElementById('docente').value = json.asesor_id;
                document.getElementById('codigoInscripcion').value = json.codigo_inscripcion;
                document.getElementById('crear').innerHTML = 'Modificar Grupo';
            }
            // swal.close();
        }
    }

    async function deleteGroup(id_group) {
        var hostname = window.location.host;
        var response = await fetch("http://" + hostname + "/api/grupos/delete/" +id_group);
        var json = await response.json();
        if (json.value) {
            swal('Cargando','Espere por favor','info',{});
            var groupSelected = document.getElementById('selected_id');
            var lastSelected = document.getElementById(groupSelected.value);;
            var newSelected = document.getElementById(0);
            lastSelected.classList.remove('active');
            newSelected.classList.add('active');
            groupSelected.value = 0;
            document.getElementById('title').innerHTML = 'Crear Grupo';
            document.getElementById('sigla').value = '';
            document.getElementById('docente').value = 'default';
            document.getElementById('codigoInscripcion').value = '';
            document.getElementById('crear').innerHTML = 'Crear Grupo';
            swal.close();
            location.reload();
        } else {
            swal('Oops...', 'No se puede eliminar. Hay estudiantes inscritos en este grupo.', 'error', {button: 'cerrar'});
        }

    }

    function showalert() {
        swal('Oops...', 'No hay un semestre activo o pendiente. Cree un semestre para que pueda crear o modificar grupos.', 'warning', {button: 'cerrar'});
    }
</script>
@endsection
