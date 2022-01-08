<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adjunto;
use App\Models\Adjunto_plan_pago;
use App\Models\Grupo;
use App\Models\Grupoempresa;
use App\Models\Semestre;
use Illuminate\Support\Facades\Session;

class PlanPagosAsesorController extends Controller
{
    public function index(){
        $user_id = Session::get('id');
        $user_type = Session::get('type');
        $title = $this->title($user_id, $user_type);
        $semestre = $this->semestreActual();
        $grupoempresas = $this->getGrupoempresas($semestre->id);
        foreach($grupoempresas as $grupoempresa)
        {
            $plan_pago = $this->getPlanPago($grupoempresa->id);
            $grupoempresa['plan_pago'] = $plan_pago;
        }
        return view('pagos.planPagosAsesor', ['user_type' => $user_type, 'title' => $title, 'grupoempresas' => $grupoempresas]);
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

    public function semestreActual()
    {
        $currentDate = date('Y-m-d');
        $semestre = Semestre::where('fecha_inicio','<=',$currentDate)
                    ->where('fecha_fin','>=',$currentDate)->first();
        return $semestre;
    }

    public function getGrupoempresas($semestre_id)
    {
        $grupoempresas = Grupo::where('semestre_id','=',$semestre_id)
        ->join('grupoempresas','grupoempresas.grupo_id','=','grupos.id')
        ->select('grupoempresas.id','grupoempresas.nombre_corto','grupoempresas.nombre_largo')
        ->get();
        return $grupoempresas;
    }

    public function getPlanPago($ge_id)
    {
        $plan_pago = Adjunto_plan_pago::where('grupoempresa_id','=',$ge_id)
        ->join('adjuntos','adjuntos.id','=','adjunto_plan_pagos.adjunto_id')
        ->select('adjuntos.*')->first();
        return $plan_pago;
    }
}
