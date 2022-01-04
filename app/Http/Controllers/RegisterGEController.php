<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asesor;
use App\Models\Calendario;
use App\Models\Calendario_grupoempresa;
use App\Models\Estudiante;
use App\Models\Grupoempresa;
use App\Models\User;
use App\Rules\CheckMiembrosGE;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterGEController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function registerGE()
    {
        return view('registerGE');
    }

    public function registrarGE(Request $request)
    {
        $rules = array(
            'nombre_corto' => ['required','unique:grupoempresas'],
            'nombre_largo' => ['required','unique:grupoempresas'],
            'telefono_ge' => ['required'],
            'tipo_sociedad' => ['required'],
            'email' => ['required','unique:grupoempresas','unique:users'],
            'direccion_ge' => ['required'],
            'miembros.*' => ['required','distinct', 'exists:users,email'],
            'miembros' => [new CheckMiembrosGE()]
        );

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user_rep_legal = User::where('email','=',$request->miembros[0])->first();
        $rep_legal = Estudiante::where('estudiantes.user_id','=',$user_rep_legal->id)->first();
        $grupo = $rep_legal->grupo;

        $grupoempresa = new Grupoempresa;
        $grupoempresa->nombre_corto = $request->nombre_corto;
        $grupoempresa->nombre_largo = $request->nombre_largo;
        $grupoempresa->direccion_ge = $request->direccion_ge;
        $grupoempresa->telefono_ge = $request->telefono_ge;
        $grupoempresa->tipo_sociedad = $request->tipo_sociedad;
        $grupoempresa->email = $request->email;
        $grupoempresa->rep_legal_id = $rep_legal->id;
        $grupoempresa->grupo_id = $grupo->id;
        $query = $grupoempresa->save();

        foreach($request->miembros as $miembro)
        {
          $user = User::where('email','=',$miembro)->first();
          $estudiante = $user->estudiante()->update(['grupoempresa_id' => $grupoempresa->id]);
        }

        if($query)
        {
          $calendario = new Calendario;
          $query2 = $calendario->save();

          $calendario_ge = new Calendario_grupoempresa;
          $calendario_ge->calendario_id = $calendario->id;
          $calendario_ge->grupoempresa_id = $grupoempresa->id;
          $query3 = $calendario_ge->save();
          session()->flash('success','GrupoEmpresa registrada');
          return redirect('listarGrupoEmpresa');
        }
        else
        {
          session()->flash('failure','GrupoEmpresa no registrada');
          return redirect('listarGrupoEmpresa')->withFailure('Grupoempresa no Registrada');
        }

    }
}
