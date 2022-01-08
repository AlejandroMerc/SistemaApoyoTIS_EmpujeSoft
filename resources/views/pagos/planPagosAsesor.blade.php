@extends('layouts.home_layout')


@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="card">
        <div id="titulo" class="card-header bg-primary">
          <h3 class=text-white>
            {{ __('Planes de Pagos') }}
          </h3>
        </div>
        <div class="card-body">
          <div class="container">
            @foreach ($grupoempresas as $grupoempresa)
            <div class= "row justify-content-center">
              <div class= "col">
                <div id="titulo">
                  <h5>
                    {{ __($grupoempresa->nombre_corto) }}
                  </h5>
                </div>
              </div>
              <div class="col">
                <div id="titulo">
                  @if ($grupoempresa->plan_pago == null)
                    <p>Aun no se ha subido un plan de pagos</p>
                  @else
                    <p><a href="{{asset($grupoempresa->plan_pago->path)}}" class="card-link"><i class="fas fa-paperclip"></i>{{$grupoempresa->plan_pago->name}}</a></p>
                  @endif
                </div>
              </div>
            </div>
            @endforeach
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
@endsection
