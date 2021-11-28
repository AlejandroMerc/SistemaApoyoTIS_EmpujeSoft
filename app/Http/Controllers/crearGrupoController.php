<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\User;
use App\Models\semestre;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $siglaIn=$request->sigla;
            //for revisar que no se repita

        $docentesArray = User::where('rol','=','asesor_tis')->select('id','name','lastname')->get();
        $currentDate = date('Y');
        $semestreArray = semestre::where('year','>=',date('Y')-1)->select('id','periodo','year')->get();

        request()->validate([

            'sigla'=>['bail','required','max:191','min:2',function ($siglaIn, $value, $fail) {
                $grupoArray = grupo::where('semestre_id','=',request('semestre'))->select('sigla_grupo')->get();
                $existe=false;
                foreach ($grupoArray as $grup) {

                    # code...
                    if($value==$grup->sigla_grupo){
                        $existe=true;
                    }
                }
                if ($existe) {
                    $fail('la '.$siglaIn.' ya esta en uso en este semestre.');
                }
            }],

            'docente'=>'bail|required',
            'codigoInscripcion'=>'bail|required|min:5|max:191',
            'semestre'=>'bail|required'
        ]);
        $grupo=new grupo;
        $grupo->sigla_grupo=$request->sigla;
        $grupo->codigo_inscripcion=request('codInscripcion');
        $grupo->semestre_id=request('semestre');
        $grupo->asesor_id=request('docente');


        if ($grupo->save()) {
            # code...
            Alert::success('Grupo Creado', 'Completado');

            return view('crearGrupo',compact('docentesArray'),compact('semestreArray'));

        }else{
            Alert::warning("no se creo grupo");

        }

    }
}
