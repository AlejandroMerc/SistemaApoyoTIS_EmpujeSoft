<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupoempresa;

class CalendarioGEController extends Controller
{
    public function index(){
        $grupoEmpresas= Grupoempresa::join('estudiantes','estudiantes.id','grupoempresas.rep_legal_id')
        ->join('grupos','grupos.id','estudiantes.grupo_id')
        ->join('semestres','semestres.id','grupos.semestre_id')
        ->select('grupoempresas.id','grupoempresas.nombre_corto','grupoempresas.nombre_largo','semestres.year','semestres.periodo')
        ->get();
        return view('evento.calendarioGE',compact('grupoEmpresas'));
        return view('evento.calendarioGE');
    }

    public function store(Request $request){
        request()->validate(Evento::$rules);
        $evento = Evento::create($request->all());
    }
    public function show(Evento $evento){
        $evento = Evento::all();
        return response()->json($evento);
    }
    
}