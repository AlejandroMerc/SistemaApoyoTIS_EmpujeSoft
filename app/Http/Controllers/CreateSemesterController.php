<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
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
        $semest=new Semestre;
        $semest->year=$request->anio;
        $semest->periodo=$request->periodo;
        $semest->fecha_inicio=$request->deathline;
        $semest->fecha_fin=$request->deathline2;
        if($semest->save()){
            return Redirect::back()->with('message','Operation Successful !');
        }else{
            return "no se guardo";
        }

    }
}
