<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Calendario;
use App\Models\Calendario_semestre;
use App\Models\Semestre;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CalendarioEventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_type = Session::get('type');
        $semestre = $this->semestreActual();
        $calendario = $semestre->calendario_semestre->calendario;
        return view('evento.index', ['calendario_id' => $calendario->id, 'user_type' => $user_type]);
    }

    public function store(Request $request){
        request()->validate(Evento::$rules);
        $evento = Evento::create($request->all());
        return response()->json($evento);
    }
    public function show(){
        $semestre = $this->semestreActual();
        $eventos = Semestre::where('semestres.id','=',$semestre->id)
        ->join('calendario_semestres','semestres.id','=','calendario_semestres.semestre_id')
        ->join('calendarios','calendarios.id','=','calendario_semestres.calendario_id')
        ->join('eventos','calendarios.id','=','eventos.calendario_id')
        ->get();
        return response()->json($eventos);
    }
    public function showCalendar($calendar_id)
    {
        $eventos = Calendario::find($calendar_id)->eventos;
        return response()->json($eventos, 200);
    }
    public function edit($id){
        $evento = Evento::find($id);
        $evento -> start = Carbon::createFromFormat('Y-m-d H:i:s',$evento -> start)->format('Y-m-d');
        $evento -> end = Carbon::createFromFormat('Y-m-d H:i:s',$evento -> end)->format('Y-m-d');
        return response()->json($evento);
    }
    public function destroy($id){
        $evento = Evento::find($id)->first();
        $evento->delete();
        return response()->json($evento);
        
    }
    public function semestreActual()
    {
        $currentDate = date('Y-m-d');
        $semestre = Semestre::where('fecha_inicio','<=',$currentDate)
                    ->where('fecha_fin','>=',$currentDate)->first();
        return $semestre;
    }
    public function calendario_id($semestre_id)
    {
        $calendario_id = Semestre::find($semestre_id)
        ->join('calendario_semestres','semestre.id','=','calendario_semestres.semestre_id')
        ->join('calendario','calendario.id','=','calendario_semestres.calendario_id')
        ->select('calendario.id')
        ->first();
        return $calendario_id;
    }
}
