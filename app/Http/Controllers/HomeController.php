<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Asesor;
use App\Models\Estudiante;
use App\Models\Grupoempresa;
use App\Models\Publicacion;
use App\Models\Publicacion_asignada_grupo;
use App\Models\Publicacion_asignada_grupoempresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        Session::save();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_type = Session::get('type');
        $id = Session::get('id');
        $title = $this->title($id);
       
        $publications=$this->publicaciones($id);
        if(!empty($publications))
        {
            foreach($publications as $pub ){
                Log::info($pub->id);
                $pub_id = $pub->id;
                $activities = Actividad::where('publicacion_id','=',$pub_id)->first();
                if(!empty($activities)){
                    $pub->tipo="Actividad";  
                    $pub->fechaDeEntrega=$activities->fecha_fin_actividad;
                }else{
                    $pub->tipo="Publicación"; 
                } 
            }
        }
        return view('home',['user_type' => $user_type, 'title' => $title],compact('publications'));
    }

    public function title($id){
        $rol = User::find($id)->rol;
        if($rol == 'admin')
        {
            return 'Administrador';
        }
        else if($rol == 'asesor_tis')
        {
            return 'Asesor TIS';
        }
        else if($rol == 'estudiante')
        {
            $estudiante = Estudiante::where('user_id',$id)->first();
            $ge_id = $estudiante->grupoempresa_id;
            if($ge_id == null)
            {
                return '[Sin grupo empresa]';
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

    public function publicaciones($id){
        $user = User::find($id);
        $rol = $user->rol;
        if($rol == 'admin')
        {
            return $this->getAllPublicaciones();
        }
        else if($rol == 'asesor_tis')
        {
            return $this->getPublicacionesAsesor($user)->get();
        }
        else if($rol == 'estudiante')
        {
            $estudiante = $user->estudiante()->first();
            $grupo = $estudiante->grupo()->first();
            $ge = $estudiante->grupoempresa()->first();
            if($ge == null)
            {
                return $this->getPublicacionesGrupo($grupo->id)->get();
            }
            else 
            {
                return $this->getPublicacionesGrupoGE($grupo->id, $ge->id)->get();
            }
        }
        else
        {
            return $this->getAllPublicaciones();
        }
    }

    public function getAllPublicaciones(){
        $publications=Publicacion::join('asesors','publicacions.asesor_id','=','asesors.id')
        ->join('users','asesors.user_id','=','users.id')
        ->select('publicacions.*','users.name','users.lastname')
        ->get();
        return $publications;
    }

    public function getPublicacionesGrupo($grupo_id){
        $publications = Publicacion::join('asesors','publicacions.asesor_id','=','asesors.id')
        ->join('users','asesors.user_id','=','users.id')
        ->join('publicacion_asignada_grupos','publicacion_asignada_grupos.publicacion_id','=','publicacions.id')
        ->where('publicacion_asignada_grupos.grupo_id','=',$grupo_id)
        ->select('publicacions.*','users.name','users.lastname');
        return $publications;
    }

    public function getPublicacionesGE($ge_id){
        $publications = Publicacion::join('asesors','publicacions.asesor_id','=','asesors.id')
        ->join('users','asesors.user_id','=','users.id')
        ->join('publicacion_asignada_grupoempresas','publicacion_asignada_grupoempresas.publicacion_id','=','publicacions.id')
        ->where('publicacion_asignada_grupoempresas.grupoempresa_id','=',$ge_id)
        ->select('publicacions.*','users.name','users.lastname');
        return $publications;
    }

    public function getPublicacionesGrupoGE($grupo_id, $ge_id)
    {
        $publications_grupo = Publicacion::join('asesors','publicacions.asesor_id','=','asesors.id')
        ->join('users','asesors.user_id','=','users.id')
        ->join('publicacion_asignada_grupos','publicacion_asignada_grupos.publicacion_id','=','publicacions.id')
        ->where('publicacion_asignada_grupos.grupo_id','=',$grupo_id)
        ->select('publicacions.*','users.name','users.lastname');

        $publications_ge = Publicacion::join('asesors','publicacions.asesor_id','=','asesors.id')
        ->join('users','asesors.user_id','=','users.id')
        ->join('publicacion_asignada_grupoempresas','publicacion_asignada_grupoempresas.publicacion_id','=','publicacions.id')
        ->where('publicacion_asignada_grupoempresas.grupoempresa_id','=',$ge_id)
        ->select('publicacions.*','users.name','users.lastname');

        $publications = $publications_grupo->union($publications_ge);
        return $publications;
    }

    public function getPublicacionesAsesor($user)
    {
        $asesor = $user->asesor()->first();
        $grupo = $asesor->grupos()->first();
        $publications = $this->getPublicacionesGrupo($grupo->id);
        
        $grupoempresas = Asesor::find($asesor->id)->grupoempresas()->get();
        foreach($grupoempresas as $ge)
        {
            $publications_ge = $this->getPublicacionesGE($ge->id);
            $publications = $publications->union($publications_ge);
        }

        return $publications;
    }

}
