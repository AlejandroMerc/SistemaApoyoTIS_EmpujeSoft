<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupoempresa;
class PlanificacionAsesorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showPlanificacion()
    {
        $grupoEmpresas= Grupoempresa::join('estudiantes','estudiantes.id','grupoempresas.rep_legal_id')
        ->join('grupos','grupos.id','estudiantes.grupo_id')
        ->join('semestres','semestres.id','grupos.semestre_id')
        ->select('grupoempresas.id','grupoempresas.nombre_corto','grupoempresas.nombre_largo','semestres.year','semestres.periodo')
        ->get();
        return view('planificacion_asesor',compact('grupoEmpresas'));
    } 
}
