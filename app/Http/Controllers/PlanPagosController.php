<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('pagos.planPagosEstudiante', ['user_type' => $user_type, 'title' => $title]);
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
}
