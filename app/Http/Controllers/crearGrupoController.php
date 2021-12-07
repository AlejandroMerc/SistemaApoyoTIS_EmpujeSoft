<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\User;
use App\Models\semestre;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use App\Models\Estudiante;
use App\Models\Grupoempresa;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;




class crearGrupoController extends Controller
{
    //

    public function index()
    {
        $docentesArray = User::where('rol','=','asesor_tis')->select('id','name','lastname')->get();
        $currentDate = date('Y');
        $semestreArray = semestre::where('year','>=',date('Y')-1)->select('id','periodo','year')->get();

        //return view('crearGrupo',compact('docentesArray'),compact('semestreArray'));

        $user_type = Session::get('type');
        $id = Session::get('id');
        //$templates = Plantilla::all();

        $title = 'Asesor';
        if($user_type == 'estudiante')
        {
            $row = Estudiante::where('user_id',$id)->first();
            $ge_id = $row->grupoempresa_id;
            if($ge_id == null)
            {
                $title = '[Sin grupo empresa]';
            }
            else
            {
                $row = Grupoempresa::where('id',$ge_id)->first();
                $title = $row->nombre_largo;
            }
        }
        return view('crearGrupo',['user_type' => $user_type, 'title' => $title,'semestreArray'=>$semestreArray, 'docentesArray'=>$docentesArray]);
    }

    public function validar(Request $request)
    {
        $siglaIn=$request->sigla;
            //for revisar que no se repita

        $docentesArray = User::where('rol','=','asesor_tis')->select('id','name','lastname')->get();
        $currentDate = date('Y');
        $semestreArray = semestre::where('year','>=',date('Y')-1)->select('id','periodo','year')->get();

        request()->validate([

            'sigla'=>['bail','required','max:191','min:1',function ($siglaIn, $value, $fail) {
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
        $grupo->codigo_inscripcion=request('codigoInscripcion');
        $grupo->semestre_id=request('semestre');
        $asesor = User::find(request('docente'))->asesor()->first();
        $grupo->asesor_id=$asesor->id;


        if ($grupo->save()) {
            # code...
            //Alert::success('Grupo Creado', 'Completado');
            return redirect()->back()->with('alert','grupo creado !');

            //return view('crearGrupo',compact('docentesArray'),compact('semestreArray'));

        }else{
            //Alert::warning("no se creo grupo");
            //return view('crearGrupo',compact('docentesArray'),compact('semestreArray'));
            return redirect()->back()->with('alert','no se creo grupo !');

        }

    }
}
