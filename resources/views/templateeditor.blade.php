@extends('layouts.home_layout')

@section('content')
    <form method="post" action="{{ route('template-editor-id', ['id' => $id]) }}" enctype="multipart/form-data">
        @csrf
        {{-- Nombre --}}
        <div class="d-flex form-group-row px-2">
            <label for="name" class="col-form-label">Nombre</label>
            <div class="col-sm-11">
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $name) }}" required>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        {{-- ckeditor --}}

        <div class="d-flex">
            <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <textarea class="ckeditor form-control" name="editor">{{ old('editor',$dochtml) }}</textarea>
                    </div>

            </div>
        </div>

        {{-- boton aceptar --}}
        <div class="d-flex flex-row-reverse pb-5 mr-5">
            <button type="submit" class="btn btn-outline-dark">Guardar</button>
        </div>
    </form>
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
    </script>
@endsection

@section('scripts')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.config.height = '30em';
    </script>
@endsection
