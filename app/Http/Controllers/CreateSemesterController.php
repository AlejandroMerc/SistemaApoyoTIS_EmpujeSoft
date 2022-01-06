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

        return view('createSemester', ['user_type' => $user_type, 'title' => $title]);
    }
    public function store(Request $request){
        $request->validate([
            'anio' => ['required', 'numeric','min:1900','max:3000'],
            'periodo'=>['required','numeric','min:1','max:3'],
            'deathline'=>['required','date'],
            'deathline2'=>['required','date']
        ]);
        //$request -> deathline = Carbon::createFromFormat('Y-m-d H:i',$request -> deathline)->format('Y-m-d');
        $format = "Y-m-d"; //or something else that date() accepts as a format
        $fechaIni = $request->deathline;
        $fechaFin = $request->deathline2;

        $fechaIni = date_format(date_create($fechaIni), $format);
        $fechaFin = date_format(date_create($fechaFin), $format);

        $fecha_ini = strtotime($fechaIni);
        $fecha_fin = strtotime($fechaFin);


        if($fecha_fin < $fecha_ini){
            //return "Fechas Incorrectas";
            return redirect()->back()->with('alert','Fechas Incorrectas');
        }

        $semest=new Semestre;
        $semest->year=$request->anio;
        $semest->periodo=$request->periodo;
        $semest->fecha_inicio=$request->deathline;
        $semest->fecha_fin=$request->deathline2;
        if($semest->save()){
            $calendario = new Calendario;
            $save2 = $calendario->save();
            $calendario_semestre = new Calendario_semestre;
            $calendario_semestre->calendario_id = $calendario->id;
            $calendario_semestre->semestre_id = $semest->id;
            $save3 = $calendario_semestre->save();
            if($save3){
                return redirect(route('home'))->with('alert','Semestre Creado !');
            }else{
                return redirect()->back()->with('alert','Error al Crear Semestre !');
            }

        }else{
            return redirect()->back()->with('alert','Error al Crear Semestre !');
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
