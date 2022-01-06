@extends('layouts.home_layout')





@section('content')

<div class="card ml-3 mr-3">
    
    <div class="card-body">
        <div class="results">
            @if (Session::get('success'))
                <div class="alert alert-sucess">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::get('failure'))
                <div class="alert alert-failure">
                    {{ Session::get('failure') }}
                </div>
            @endif
        </div>
        <div >
            <h3 class="card-title text-center">Lista de Grupo Empresas</h1>
        </div>
        <table id="tablaGE" class="table table-striped table-bordered" style="width:100%">
            <thead >
                <tr>
                    <th>ID</th>
                    <th>Nombre Corto</th>
                    <th>Nombre Largo</th>
                    <th>Gestión</th>
                    
                </tr>
            </thead>
            <tbody>    
                @foreach ($grupoEmpresas as $grupoempresa)
                    <tr>
                        <td>
                            {{$grupoempresa->id}}
                        </td>
                        <td>
                            <a href="{{ route('perfilGE',$grupoempresa->id) }}" method('POST') action="{{ route('perfilGE',$grupoempresa->id) }}">{{$grupoempresa->nombre_corto}}</a>
                        </td>
                        <td>
                            {{$grupoempresa->nombre_largo}}
                        </td>
                        <td>
                            {{$grupoempresa->periodo}}/{{$grupoempresa->year}}
                        </td>
                    </tr> 
                @endforeach    
                @foreach ($historico_ge as $grupoempresa)
                    <tr>
                        <td>
                            {{$grupoempresa->id}}
                        </td>
                        <td>
                            {{$grupoempresa->nombre_corto}}
                        </td>
                        <td>
                            {{$grupoempresa->nombre_largo}}
                        </td>
                        <td>-</td>
                    </tr> 
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>

@endsection

