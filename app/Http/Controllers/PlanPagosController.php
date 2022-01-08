<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adjunto;
use App\Models\Adjunto_plan_pago;
use App\Models\Estudiante;
use App\Models\Calendario;
use App\Models\Evento;
use App\Models\Grupoempresa;
use Illuminate\Support\Facades\Session;

class PlanPagosController extends Controller
{
    public function index(){
        $user_id = Session::get('id');
        $user_type = Session::get('type');
        $title = $this->title($user_id, $user_type);
        $plan_pagos = $this->getPlanPagos();
        return view('pagos.planPagosEstudiante', ['user_type' => $user_type, 'title' => $title, 'plan_pagos' => $plan_pagos]);
    }

    private function title($id, $rol){
        if ($rol === 'admin')
        {
            return 'Administrador';
        }
        else if ($rol === 'asesor_tis')
        {
            return 'Asesor TIS';
        }
        else if ($rol === 'estudiante')
        {
            $estudiante = Estudiante::where('user_id',$id)->first();
            $ge_id = $estudiante->grupoempresa_id;
            if ($ge_id === null)
            {
                return 'Sin grupoempresa';
            }
            else
            {
                $ge = Grupoempresa::where('id',$ge_id)->first();
                return $ge->nombre_largo;
            }
        }
        else
        {
            return 'Invitado';
        }
    }

    private function getPlanPagos()
    {
        $id = Session::get('id');
        $estudiante = Estudiante::where('user_id',$id)->first();
        $ge_id = $estudiante->grupoempresa_id;
        $plan_pagos = Adjunto_plan_pago::where('grupoempresa_id','=',$ge_id)
        ->join('adjuntos','adjuntos.id','=','adjunto_plan_pagos.adjunto_id');
        return $plan_pagos->first();
    }

    public function subirPlanPagos(Request $request) 
    {
        if($request->plan_pago != null)
        {
            $adjunto = new Adjunto;
            $adjunto->name = $request->plan_pago->getClientOriginalName();
            $adjunto->path = $request->plan_pago->store('files');
            $adjunto->save();

            $id = Session::get('id');
            $estudiante = Estudiante::where('user_id',$id)->first();
            $ge_id = $estudiante->grupoempresa_id;

            Adjunto_plan_pago::updateOrInsert(
                ['grupoempresa_id' => $ge_id],
                ['adjunto_id' => $adjunto->id]
            );
        }
        return redirect('planPagos')->with('alert-success','Plan de pagos registrado');
    }

    public function saveFiles($uploadFiles)
    {
        $adjunto = new Adjunto;
        $adjunto->name = $uploadFiles->getClientOriginalName();
        $adjunto->path = $uploadFiles->store('files');
        return $adjunto;
    }
}
