<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\User;
use App\Models\Semestre;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use App\Models\Estudiante;
use App\Models\Grupoempresa;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;



class crearGrupoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $docentesArray = User::where('rol','=','asesor_tis')->select('id','name','lastname')->get();
        $currentDate = date('Y');
        $semestreArray = Semestre::where('year','>=',date('Y')-1)->select('id','periodo','year')->get();

        //return view('crearGrupo',compact('docentesArray'),compact('semestreArray'));

        $user_type = Session::get('type');
        $id = Session::get('id');
        //$templates = Plantilla::all();

        $title = 'Administrador';
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

        $rules = [

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
                    $fail('la sigla ya esta en uso en este semestre.');
                }
            }],

            'docente'=>'bail|required',
            'codigoInscripcion'=>['bail','required','min:5','max:199',
            function ($codInscripcion, $value, $fail) {
                $grupoArray = grupo::where('semestre_id','=',request('semestre'))->select('codigo_inscripcion')->get();
                $existe=false;
                foreach ($grupoArray as $grup) {

                    # code...
                    if($value==$grup->codigo_inscripcion){
                        $existe=true;
                    }
                }
                if ($existe) {
                    $fail('el codigo de inscripcion ya esta en uso en este semestre.');
                }
            }],
            'semestre'=>'bail|required'
        ];
        $errores = [
            'required' => 'Este campo es obligatorio',
            'min' => 'El codigo de inscripcion debe ser minimo 5 caracteres',
            'max' => 'El codigo de inscripcion debe ser menor de 199'
        ];
        $this -> validate($request,$rules,$errores);
        //return "pasamos validacion :,u";

        $grupo=new grupo;
        $grupo->sigla_grupo=$request->sigla;
        $grupo->codigo_inscripcion=request('codigoInscripcion');
        $grupo->semestre_id=request('semestre');
        $asesor = User::find(request('docente'))->asesor()->first();
        $grupo->asesor_id=$asesor->id;
        $user = User::findOrFail($asesor->id);
        $semestre =Semestre::findOrFail($request->semestre);
        if ($grupo->save()) {
            Mail::send('emails.mailCrearGrupo', ['request' => $request,'user'=>$user,'semestre'=>$semestre], function ($m) use ($user) {
                $m->from('hello@app.com', 'Sistema de apoyo TIS');
    
                $m->to($user->email, $user->name)->subject('Se a creado grupo de materia!');
                
            });
            # code...
            //Alert::success('Grupo Creado', 'Completado');
            return redirect()->back()->with('alert','Grupo Creado !');

            //return view('crearGrupo',compact('docentesArray'),compact('semestreArray'));

        }else{
            //Alert::warning("no se creo grupo");
            //return view('crearGrupo',compact('docentesArray'),compact('semestreArray'));
            //return "no se pudo loco";
            return redirect()->back()->with('alert','no se creo grupo !');

        }

    }
}
