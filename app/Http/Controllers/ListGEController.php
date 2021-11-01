<?php

namespace App\Http\Controllers;

use App\Models\Grupoempresa;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListGEController extends Controller
{
    //
    public function showListGE()
    {
        $grupoEmpresas= Grupoempresa::join('users','users.id','grupoempresas.rep_legal_id')
        ->join('estudiantes','estudiantes.user_id','users.id')
        ->join('grupos','grupos.id','estudiantes.grupo_id')
        ->join('semestres','semestres.id','grupos.semestre_id')
        ->select('grupoempresas.id','grupoempresas.nombre_corto','grupoempresas.nombre_largo','semestres.year','semestres.periodo')
        ->get();
        
        
        return view('listGE', compact('grupoEmpresas'));
    }
}
