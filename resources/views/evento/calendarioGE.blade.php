@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">{{ __('Grupo Empresas') }}</div>
                    <div class="card w-30">
                        @foreach ($grupoEmpresas as $grupoempresa)    
                            <div class="card-body">
                                <a href="#" class="btn btn-primary">{{$grupoempresa->nombre_corto}}</a>
                            </div>
                        @endforeach 
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">{{ __('Calendario de Grupo Empresas') }}</div>
                        <div class="card w-20">
                            <div class="card-body">
                                <div class="col-md-12">
                                        <div class="form-group row">
                                          <div class="container">
                                            <div id="calendario">
                                          </div> 
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="modelTitleId">Evento</h4>
          </div>
          <div class="modal-body">
            <form action="" id="formularioEventos">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="title" class="col-md-8 col-form-label">{{ __('*Nombre de Evento') }}</label>
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Nombre Evento"></input>
                </div>            
                <div class="form-group">
                    <label for="description" class="col-md-1 col-form-label">{{ __('*Descripción') }}</label>
                    <textarea style="resize: none;" class="form-control @error('description') is-invalid @enderror" name="description" rows="3" id="description" required autofocus></textarea>
                </div>
                <div class="form-group">
                    <label for="start" class="col-md-1 col-form-label">{{ __('*Start') }}</label>
                    <input type="date" class="form-control" name="start" id="start" aria-describedby="helpId" placeholder="Fecha de Inicio"></input>
                </div>
                <div class="form-group">
                    <label for="end" class="col-md-1 col-form-label">{{ __('*End') }}</label>
                    <input type="date" class="form-control" name="end" id="end" aria-describedby="helpId" placeholder="Fecha de Fin"></input>
                </div>        
            </form>
          </div>
          <div class="modal-footer">
            <!--
            <button type="button" class="btn btn-success" id="btn_guardar" data-dismiss="modal">Guardar</button>
            <button type="button" class="btn btn-warning" id="btn_modificar">Modificar</button>
            <button type="button" class="btn btn-danger" id="btn_eliminar">Eliminar</button>
             -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>            
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
@endsection