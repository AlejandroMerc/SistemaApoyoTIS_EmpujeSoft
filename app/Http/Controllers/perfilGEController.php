<?php

namespace App\Http\Controllers;

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
        $user_type = Session::get('type');
        $title = 'Perfil GE';
        $GrupoE = Grupoempresa::where('id','=',$id)->first();
        $rep_legal_id=$GrupoE->rep_legal_id;
        $representante = Estudiante::where('estudiantes.id','=',$rep_legal_id)
        ->join('users','users.id','=','estudiantes.user_id')
        ->select('users.name','users.lastname')->first();
        
        $integrantesArray = User::join("estudiantes","estudiantes.user_id","=","users.id")
        ->where('estudiantes.grupoempresa_id','=',$id)
        ->where('estudiantes.id','!=',$rep_legal_id)
        ->select('users.name','users.lastname')->get();
        /*$aux=0;
        foreach($integrantesArray as $integrante){
            $aux++;
        }*/
        //return $representante;
        //Console.log("llegue");
        //$GwE=Grupoempresa::where('nombre_corto','=',$nombre_grupo)->select('id')->get();
        return view('perfilGE',['user_type' => $user_type, 'title' => $title,'integrantesArray'=>$integrantesArray, 'grupoEmpresa'=>$GrupoE,'representante'=>$representante]);;
    }
}
