<?php

namespace App\Http\Controllers;

use App\Models\Adjunto;
use App\Models\Adjunto_logo;
use Illuminate\Http\Request;
use App\Models\Asesor;
use App\Models\Calendario;
use App\Models\Calendario_grupoempresa;
use App\Models\Estudiante;
use App\Models\Grupoempresa;
use App\Models\User;
use App\Rules\CheckMember;
use App\Rules\CheckMiembrosGE;
use App\Rules\IsEstudent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RegisterGEController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function registerGE()
    {
        $user_type = Session::get('type');
        $id = Session::get('id');

        $estudiante=Estudiante::where('user_id',$id)->first();
        if($estudiante!=null){
            if($estudiante->grupoempresa_id!=null){
                return redirect()->back()->with('alert-error','Ya pertenece a una Grupo Empresa');
            }
        }
        
       $title = $this->title($id, $user_type);
        return view('registerGE',['user_type' => $user_type, 'title' => $title]);
    }

    public function registrarGE(Request $request)
    {
        
        $request->validate([
            'nombre_corto' => ['required','unique:grupoempresas'],
            'nombre_largo' => ['required','unique:grupoempresas'],
            'telefono_ge' => ['required'],
            'tipo_sociedad' => ['required'],
            'email' => ['required','unique:grupoempresas','unique:users'],
            'direccion_ge' => ['required'],
            'correoRepresentanteLegal'=>['required','email',new IsEstudent(), new CheckMember()],
            'correoMiembro2'=>['required','email',new IsEstudent(),new CheckMember()],
            'correoMiembro3'=>['required','email',new IsEstudent(),new CheckMember()],
            'correoMiembro4'=>[new IsEstudent(),new CheckMember()],
            'correoMiembro5'=>[new IsEstudent(),new CheckMember()],
            'logo'=>['required','mimes:jpg,png,jpeg,gif,svg','max:2048','dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000']
        ]);
        $correos[]= $request->correoRepresentanteLegal;
        $correos[]=$request->correoMiembro2;
        $correos[]=$request->correoMiembro3;
        if($request->correoMiembro4!=null){
            $correos[]=$request->correoMiembro4;
        }
        if($request->correoMiembro5!=null){
            $correos[]=$request->correoMiembro5;

        }
      
      
        $hayRepetidos=count($correos) !== count(array_unique($correos));
        if($hayRepetidos){
            return redirect()->back()->with('alert-error','Error al Crear Grupo Empresa. Existen correos repetidos');
        }
            

        $user_rep_legal = User::where('email','=',$request->correoRepresentanteLegal)->first();
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

        $rep_legal->update(['grupoempresa_id' => $grupoempresa->id]);

          $user2 = User::where('email','=',$request->correoMiembro2)->first();
           $user2->estudiante()->update(['grupoempresa_id' => $grupoempresa->id]);

          $user3 = User::where('email','=',$request->correoMiembro3)->first();
          $user3->estudiante()->update(['grupoempresa_id' => $grupoempresa->id]);
        
            if($request->correoMiembro4!=null){
                $user4 = User::where('email','=',$request->correoMiembro4)->first();
                $user4->estudiante()->update(['grupoempresa_id' => $grupoempresa->id]);
            }
            if($request->correoMiembro5!=null){
                $user5 = User::where('email','=',$request->correoMiembro5)->first();
                $user5->estudiante()->update(['grupoempresa_id' => $grupoempresa->id]);
            }
        if($query)
        {
          $calendario = new Calendario;
          $query2 = $calendario->save();

          $calendario_ge = new Calendario_grupoempresa;
          $calendario_ge->calendario_id = $calendario->id;
          $calendario_ge->grupoempresa_id = $grupoempresa->id;
          $query3 = $calendario_ge->save();
        
        $adjunto = new Adjunto;
        $adjunto->name = $request->logo->getClientOriginalName();
        $adjunto->path = $request->logo->store('files');
        $adjunto->save();
        $adjunto_logo=new Adjunto_logo;
        $adjunto_logo->grupoempresa_id=$grupoempresa->id;
        $adjunto_logo->adjunto_id=$adjunto->id;
        $adjunto_logo->save();

          return redirect('listarGrupoEmpresa')->with('alert-success','Grupo Empresa Registrada!');
        }
        else
        {
          session()->flash('failure','GrupoEmpresa no registrada');
          return redirect('listarGrupoEmpresa')->withFailure('Grupoempresa no Registrada');
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
