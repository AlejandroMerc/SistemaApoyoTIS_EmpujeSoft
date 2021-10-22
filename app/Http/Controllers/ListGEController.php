<?php

namespace App\Http\Controllers;

use App\Models\grupoempresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListGEController extends Controller
{
    //
    public function showListGE()
    {
        $grupoEmpresas= DB::table('grupoempresas')
        ->join('estudiantes','grupoempresas.rep_legal_id','=','estudiantes.id')
        ->join('grupos','estudiantes.grupo_id','=','grupos.id')
        ->join('semestres','grupos.semestre_id','=','semestres.id')
        ->select('grupoempresas.*','semestres.anio','semestres.periodo')
        ->get();
        
        
        return view('listGE', compact('grupoEmpresas'));
    }
}
