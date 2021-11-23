@extends('layouts.home_layout')

@section('content')
    <form method="post" action="" enctype="multipart/form-data">

        {{-- Nombre --}}
        <div class="d-flex form-group-row px-2">
            <label for="name" class="col-form-label">Nombre</label>
            <div class="col-sm-11">
                <input type="text" id="name" name="name" class="form-control">
            </div>
        </div>


        {{-- ckeditor --}}

        <div class="d-flex">
            <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <textarea class="ckeditor form-control" name="wysiwyg-editor">{{$dochtml}}</textarea>
                    </div>

            </div>
        </div>

        {{-- boton aceptar --}}
        <div class="d-flex flex-row-reverse pb-5 mr-5">
            <button type="submit" class="btn btn-outline-dark">Guardar</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.config.height = '30em';
    </script>
@endsection
