<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Models\Calendario;
use App\Models\Calendario_semestre;
use App\Models\Estudiante;
use App\Models\Grupoempresa;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CreateSemesterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function createSemester(){
        $user_type = Session::get('type');
        $id = Session::get('id');
        $title = $this->title($id, $user_type);

        $current = date('Y');

        return view('createSemester', ['user_type' => $user_type, 'title' => $title, 'current_year' => $current]);
    }
    public function store(Request $request){
        $current = date('Y');
        $rules = [
            'anio' => ['required', 'numeric','min:'.$current, 'max:'.($current+1)],
            'periodo'=>['required','numeric','min:1','max:4'],
            'FechaInicio'=>['required','date','before_or_equal:FechaFin'],
            'FechaFin'=>['required','date','after_or_equal:FechaInicio']
        ];

        $err_msg = [
            'anio.min' => 'No se puede crear semestres para años pasados',
            'anio.max' => 'No se puede crear semestres muy lejanos',
            'periodo.max' => 'Periodo no debe ser mayor que 4'
        ];
        $this->validate($request, $rules, $err_msg);

        $semest=new Semestre;
        $semest->year=$request->anio;
        $semest->periodo=$request->periodo;
        $semest ->fecha_inicio=$request->FechaInicio;
        $semest->fecha_fin=$request->FechaFin;
        if($semest->save()){
            $calendario = new Calendario;
            $save2 = $calendario->save();
            $calendario_semestre = new Calendario_semestre;
            $calendario_semestre->calendario_id = $calendario->id;
            $calendario_semestre->semestre_id = $semest->id;
            $save3 = $calendario_semestre->save();
            if($save3){
                return redirect(route('home'))->with('alert-success','Semestre Creado !');
            }else{
                return redirect()->back()->with('alert-error','Error al Crear Semestre !');
            }

        }else{
            return redirect()->back()->with('alert-error','Error al Crear Semestre !');
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
