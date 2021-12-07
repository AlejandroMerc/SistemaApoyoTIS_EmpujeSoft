@extends('layouts.listGEmpresa')



@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    @endsection

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
                            {{$grupoempresa->nombre_corto}}
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

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"> </script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script>
        $('#tablaGE').DataTable({
            responsive:true,
            autoWidth:false,
        
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No hay resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar",
            "paginate":{
                "next":"Siguiente",
                "previous":"Anterior"
            }
        }
        });
       
    </script>
@endsection