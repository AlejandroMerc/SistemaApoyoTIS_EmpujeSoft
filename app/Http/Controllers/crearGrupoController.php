<?php

namespace App\Http\Controllers;

use App\Models\Asesor;
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
        $user_type = Session::get('type');
        $user_id = Session::get('id');
        $title = $this->title($user_id, $user_type);

        $docentesArray = User::where('rol','=','asesor_tis')
        ->join('asesores', 'asesores.user_id','=','users.id')
        ->select('asesores.id','name','lastname')->get();

        $current_date = date('Y-m-d');
        $semester = Semestre::whereDate('fecha_fin','>=',$current_date)->get();

        $haySemestre = !$semester->isEmpty();

        if ( $haySemestre )
        {
            $current_semester = $semester->first();
            $grupos = [];
            $grupos = $current_semester->grupos()
                ->select('id','sigla_grupo','asesor_id')->get();
            $asesores = [];
            foreach ( $grupos as $grupo )
            {
                $asesor_id = $grupo->asesor_id;
                $asesor_name = Asesor::where('asesores.id',$asesor_id)
                ->join('users','asesores.user_id','=','users.id')->first()->name;
                $asesores[$asesor_id] = $asesor_name;
            }
            return view('crearGrupo',[
                'user_type' => $user_type,
                'title' => $title,
                'docentesArray' => $docentesArray,
                'haySemestre' => $haySemestre,
                'semestre' => $current_semester,
                'grupos' => $grupos,
                'asesores' => $asesores
            ]);
        }

        return view('crearGrupo',[
            'user_type' => $user_type,
            'title' => $title,
            'docentesArray' => $docentesArray,
            'haySemestre' => $haySemestre,
        ]);
    }

    public function validar(Request $request)
    {
        if ($request->group_id == 0)
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
            $asesor = Asesor::where('id',$request->docente)->first();
            $grupo->asesor_id=$request->docente;
            $user = User::findOrFail($asesor->id);
            $semestre =Semestre::findOrFail($request->semestre);
            if ($grupo->save()) {
                // Mail::send('emails.mailCrearGrupo', ['request' => $request,'user'=>$user,'semestre'=>$semestre], function ($m) use ($user) {
                //     $m->from('hello@app.com', 'Sistema de apoyo TIS');

                //     $m->to($user->email, $user->name)->subject('Se a creado grupo de materia!');

                // });
                return redirect()->back()->with('alert-success','Grupo Creado !');

            }else{
                return redirect()->back()->with('alert-error','no se creo grupo !');

            }
        }
        else
        {
            $pastGroup = Grupo::find($request->group_id);
            $cambios = false;
            if ( $pastGroup->sigla_grupo != $request->sigla )
            {
                $rules = [
                    'sigla'=>['required','max:191','min:1',function ($siglaIn, $value, $fail) {
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
                ];
                $errores = [
                ];
                $this -> validate($request,$rules,$errores);
                $pastGroup->sigla_grupo = $request->sigla;
                $cambios = true;
            }
            if ( $pastGroup->asesor_id != $request->docente)
            {
                $rules = [
                    'docente'=>'required'
                ];
                $errores = [
                    'required' => 'Este campo es obligatorio',
                ];
                $this -> validate($request,$rules,$errores);

                $pastGroup->asesor_id = $request->docente;
                $cambios = true;
            }
            if ( $pastGroup->codigo_inscripcion != $request->codigoInscripcion )
            {
                $rules = [
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
                    }]
                ];
                $errores = [
                    'required' => 'Este campo es obligatorio',
                    'min' => 'El codigo de inscripcion debe ser minimo 5 caracteres',
                    'max' => 'El codigo de inscripcion debe ser menor de 199'
                ];
                $this -> validate($request,$rules,$errores);

                $pastGroup->codigo_inscripcion = $request->codigoInscripcion;
                $cambios = true;
            }
            if ($cambios) {
                $saved = $pastGroup->save();
                if ($saved)
                {
                    return redirect()->back()->with('alert-success','Se modificó el grupo!');
                }
                else
                {
                    return redirect()->back()->with('alert-error','Hubo un error al modificar. Intentelo de nuevo mas tarde');
                }
            } else {
                return redirect()->back()->with('alert-success','No hay cambios a modificar!');
            }

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
