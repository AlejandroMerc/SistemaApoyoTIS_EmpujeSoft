<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Models\Calendario;
use App\Models\Calendario_semestre;
use App\Models\Semestre;
use Illuminate\Http\Request;

class CreateSemesterController extends Controller
{
    public function createSemester(){
        return view('createSemester');
    }
    public function store(Request $request){
        $request->validate([
            'anio' => ['required', 'numeric','min:1900','max:3000'],
            'periodo'=>['required','numeric','min:1','max:3'],
            'deathline'=>['required','date'],
            'deathline2'=>['required','date']
        ]);
        $correcto = strtotime($request -> deathline2) > strtotime($request -> deathline);
        if(!$correcto){
            return Redirect::back()->with('message','Fechas Incorrectas');
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
            return Redirect::back()->with('message','Se guardo correctamente !');
        }else{
            return "no se guardo";
        }

    }
}
