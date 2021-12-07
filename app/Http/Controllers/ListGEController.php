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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showListGE()
    {
        $grupoEmpresas= Grupoempresa::join('estudiantes','estudiantes.id','grupoempresas.rep_legal_id')
        ->join('grupos','grupos.id','estudiantes.grupo_id')
        ->join('semestres','semestres.id','grupos.semestre_id')
        ->select('grupoempresas.id','grupoempresas.nombre_corto','grupoempresas.nombre_largo','semestres.year','semestres.periodo')
        ->get();

        $historico_ge = Grupoempresa::whereNull('grupo_id')->get();

        return view('listGE', compact('grupoEmpresas'), compact('historico_ge'));
    }
}
