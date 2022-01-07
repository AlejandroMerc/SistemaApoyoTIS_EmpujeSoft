<?php

namespace App\Http\Controllers;

use App\Models\Adjunto;
use App\Models\Adjunto_logo;
use Illuminate\Support\Facades\Session;
use App\Models\Estudiante;
use App\Models\Grupoempresa;
use App\Models\User;

use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;
class perfilGEController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id){
        $user_id = Session::get('id');
        $user_type = Session::get('type');
        $title = $this->title($user_id, $user_type);

        $GrupoE = Grupoempresa::where('id','=',$id)->first();
        $rep_legal_id=$GrupoE->rep_legal_id;
        $representante = Estudiante::where('estudiantes.id','=',$rep_legal_id)
        ->join('users','users.id','=','estudiantes.user_id')
        ->select('users.name','users.lastname')->first();

        $integrantesArray = User::join("estudiantes","estudiantes.user_id","=","users.id")
        ->where('estudiantes.grupoempresa_id','=',$id)
        ->where('estudiantes.id','!=',$rep_legal_id)
        ->select('users.name','users.lastname')->get();

        $adjunto_logo=Adjunto_logo::where('grupoempresa_id',$id)->first();
        $logo=Adjunto::where('id',$adjunto_logo->adjunto_id)->first();

        $GrupoE['logo']=$logo;
        /*$aux=0;
        foreach($integrantesArray as $integrante){
            $aux++;
        }*/
        //return $representante;
        //Console.log("llegue");
        //$GwE=Grupoempresa::where('nombre_corto','=',$nombre_grupo)->select('id')->get();
        return view('perfilGE',['user_type' => $user_type, 'title' => $title,'integrantesArray'=>$integrantesArray, 'grupoEmpresa'=>$GrupoE,'representante'=>$representante]);;
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
