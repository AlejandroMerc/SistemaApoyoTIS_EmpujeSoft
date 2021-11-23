<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\User;
use App\Models\semestre;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

use RealRashid\SweetAlert\Facades\Alert;




class crearGrupoController extends Controller
{
    //

    public function index()
    {
        $docentesArray = User::where('rol','=','asesor_tis')->select('id','name','lastname')->get();
        $currentDate = date('Y');
        $semestreArray = semestre::where('year','>=',date('Y')-1)->select('id','periodo','year')->get();

        return view('crearGrupo',compact('docentesArray'),compact('semestreArray'));
    }

    public function validar(Request $request)
    {

        request()->validate([
            'sigla'=> 'bail|required|max:191|min:2',
            //'sigla'=> Rule::unique('grupo', 'sigla_grupo'),
            'docente'=>'bail|required',
            'codInscripcion'=>'bail|required|min:5|max:191',
            'semestre'=>'bail|required'
        ]);
        $grupo=new grupo;
        $grupo->sigla_grupo=$request->sigla;
        $grupo->codigo_inscripcion=request('codInscripcion');
        $grupo->semestre_id=request('semestre');
        $grupo->asesor_id=request('docente');

        $docentesArray = User::where('rol','=','asesor_tis')->select('id','name','lastname')->get();
        $currentDate = date('Y');
        $semestreArray = semestre::where('year','>=',date('Y')-1)->select('id','periodo','year')->get();
        if ($grupo->save()) {
            # code...
            Alert::success('Grupo Creado', 'Completado');


        }
        return view('crearGrupo',compact('docentesArray'),compact('semestreArray'));
    }
}
