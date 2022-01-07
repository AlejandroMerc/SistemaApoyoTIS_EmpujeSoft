<?php

namespace App\Http\Controllers;

use App\Models\Asesor;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\Semestre;
use App\Rules\CodigoInscripcionGrupo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterStudentController extends Controller
{
    public function index ()
    {
        $currentDate = date('Y-m-d');
        $semestre = Semestre::where('fecha_inicio','<=',$currentDate)
        ->where('fecha_fin','>=',$currentDate)->first();

        $grupos = [];
        if(!empty($semestre))
        {
            $grupos = $semestre->grupos()
            ->select('id','sigla_grupo','asesor_id')->get();
        }
        $asesores = [];
        foreach ( $grupos as $grupo )
        {
            $asesor_id = $grupo->asesor_id;
            $asesor_name = Asesor::where('asesores.id',$asesor_id)
            ->join('users','asesores.user_id','=','users.id')->first()->name;
            $asesores[$asesor_id] = $asesor_name;
        }
        return view('auth.registerStudent', ['asesores'=>$asesores], compact('grupos'));
    }

    public function registerData(Request $request)
    {
        $codigo = Grupo::where('id',$request->grupo)
        ->first()
        ->codigo_inscripcion;

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50','regex:/^[\pL\s\-]+$/u'],
            'lastname'=>['required','string','max:50','regex:/^[\pL\s\-]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'codigo_inscripcion'=>['required','string', new CodigoInscripcionGrupo($codigo)],
            'cod_sis'=>['required','numeric','unique:estudiantes']
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->rol = 'estudiante';
        $query1 = $user->save();

        $estudiante = new Estudiante;
        $estudiante->user_id = $user->id;
        $estudiante->cod_sis = $request->cod_sis;
        $estudiante->carrera = $request->carrera;
        $estudiante->grupo_id = $request->grupo;
        $query2 = $estudiante->save();

        if($query1 && $query2){
            return redirect('login')->with('alert-success','Usuario Registrado');
        }
        else{
            return redirect('login')->with('alert-error','Hubo un error al guardar los datos');
        }

    }
}
