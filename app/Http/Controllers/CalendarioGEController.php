<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Calendario;
use App\Models\Grupoempresa;
use Illuminate\Support\Facades\Session;

class CalendarioGEController extends Controller
{
    public function index(){
        $user_type = Session::get('type');
        $grupoEmpresas= Grupoempresa::join('estudiantes','estudiantes.id','grupoempresas.rep_legal_id')
        ->join('grupos','grupos.id','estudiantes.grupo_id')
        ->join('semestres','semestres.id','grupos.semestre_id')
        ->select('grupoempresas.id','grupoempresas.nombre_corto','grupoempresas.nombre_largo','semestres.year','semestres.periodo')
        ->get();
        foreach($grupoEmpresas as $grupoempresa)
        {
            $calendario = Grupoempresa::find($grupoempresa->id)->calendario_ge->calendario;
            $grupoempresa['calendario_id'] = $calendario->id;
        }
        if($user_type == 'asesor_tis'){
            return view('evento.calendarioGE', ['user_type' => $user_type], compact('grupoEmpresas'));
        }
        else
        {
            $id = Session::get('id');
            $estudiante = Estudiante::where('user_id',$id)->first();
            $ge_id = $estudiante->grupoempresa_id;
            $calendario = Grupoempresa::find($ge_id)->calendario_ge->calendario;
            return view('evento.calendarioEstudiante', ['user_type' => $user_type, 'calendario_id' => $calendario->id, 'grupoempresa_id' => $ge_id], compact('grupoEmpresas'));
        }
    }

    public function store(Request $request){
        request()->validate(Evento::$rules);
        $evento = Evento::create($request->all());
    }
    public function showCalendar($calendar_id)
    {
        $eventos = Calendario::find($calendar_id)->eventos;
        return response()->json($eventos, 200);
    }
    public function showCalendarGE($grupoempresa_id){
        if($grupoempresa_id != null)
        {
            $eventos = Grupoempresa::where('grupoempresas.id','=',$grupoempresa_id)
            ->join('calendario_grupoempresas','grupoempresas.id','=','calendario_grupoempresas.grupoempresa_id')
            ->join('calendarios','calendarios.id','=','calendario_grupoempresas.calendario_id')
            ->join('eventos','calendarios.id','=','eventos.calendario_id')
            ->get();
            return($eventos);
            return response()->json($eventos);
        }
        else
        {
            return response()->json();
        }
    }
    
}
