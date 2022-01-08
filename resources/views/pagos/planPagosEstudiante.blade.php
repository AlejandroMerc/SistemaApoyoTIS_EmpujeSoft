@extends('layouts.home_layout')


@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="card">
        <div id="titulo" class="card-header bg-primary">
          <h3 class=text-white>
            {{ __('Plan de Pagos') }}
          </h3>
        </div>
        <div class="card-body">
          <div class="container">
            <div class= "row justify-content-center">
              <div class= "col">
                <div id="titulo">
                  <h5>
                    {{ __('Documento de registro de plan de pagos:') }}
                  </h5>
                </div>
              </div>
              <div class="col">
                <div id="titulo">
                  @empty ($plan_pagos)
                    <p>Aun no se ha subido un plan de pagos</p>
                  @else
                    <p><a href="{{asset($plan_pagos->path)}}" class="card-link"><i class="fas fa-paperclip"></i>{{$plan_pagos->name}}</a></p>
                  @endempty
                </div>
              </div>
            </div>
            <form method="POST" action="{{ route('subirPlanPagos') }}" enctype="multipart/form-data">
              @csrf
              <div class="input-group hdtuto control-group lst increment" >
                <input id="plan_pago" type="file" class="form-control @error('plan_pago') is-invalid @enderror" name="plan_pago" required autofocus accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                  @error('plan_pago')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                <div class="input-group-btn">
                  <button class="btn btn-outline-success" type="submit"><i class="fldemo glyphicon glyphicon-plus"></i>
                    Subir plan de pagos
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
<script>
  var msg = '{{Session::get('alert')}}';
  Console.log(msg);
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
