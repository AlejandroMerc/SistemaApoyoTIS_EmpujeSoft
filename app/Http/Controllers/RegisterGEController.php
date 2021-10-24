<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Grupoempresa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterGEController extends Controller
{
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
            'email' => ['required','unique:grupoempresas'],
            'direccion_ge' => ['required'],
            'miembros.*' => ['required','distinct'],
        );
        
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $rep_legal_id = DB::table('users')
                        ->where('email','=',$request->miembros[0])
                        ->value('id');
        
        $grupo_id = DB::table('estudiantes')
                    ->where('user_id','=',$rep_legal_id)
                    ->value('grupo_id');

        $asesor_id = DB::table('grupos')
                     ->where('id','=',$grupo_id)
                     ->value('asesor_id');

        $grupoempresa = new Grupoempresa;
        $grupoempresa->nombre_corto = $request->nombre_corto;
        $grupoempresa->nombre_largo = $request->nombre_largo;
        $grupoempresa->direccion_ge = $request->direccion_ge;
        $grupoempresa->telefono_ge = $request->telefono_ge;
        $grupoempresa->tipo_sociedad = $request->tipo_sociedad;
        $grupoempresa->email = $request->email;
        $grupoempresa->rep_legal_id = $rep_legal_id;
        $grupoempresa->asesor_id = $asesor_id;
        $query = $grupoempresa->save();

        foreach($request->miembros as $miembro)
        {
          $user_id = DB::table('users')
                     ->where('email','=',$miembro)
                     ->value('id');
          $estudiante = DB::table('estudiantes')
                      ->where('user_id','=',$user_id)
                      ->update(['grupoempresa_id' => $grupoempresa->id]);
        }

        if($query)
        {
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
