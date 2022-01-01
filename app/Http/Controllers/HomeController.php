<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Adjunto;
use App\Models\Adjunto_publicacion;
use App\Models\Asesor;
use App\Models\Estudiante;
use App\Models\Grupoempresa;
use App\Models\Publicacion;
use App\Models\Publicacion_grupo;
use App\Models\Publicacion_grupoempresa;
use App\Models\Semestre;
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
                Log::info($pub);
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
        $title;
        switch($rol)
        {
            case 'admin':
                $title = 'Administrador';
                break;
            case 'asesor_tis':
                $title = 'Asesor TIS';
                break;
            case 'estudiante':
                $estudiante = Estudiante::where('user_id',$id)->first();
                $ge_id = $estudiante->grupoempresa_id;
                if($ge_id == null)
                {
                    $title = 'Sin grupoempresa';
                }
                else
                {
                    $ge = Grupoempresa::where('id',$ge_id)->first();
                    $title = $ge->nombre_largo;
                }
                break;
            default:
                $title = 'Invitado';
        }
        return $title;
    }

    public function publicaciones($id){
        $user = User::find($id);
        $rol = $user->rol;
        if($rol == 'admin')
        {
            $publicaciones = $this->getAllPublicaciones();
        }
        else
        {
            switch($rol)
            {
                case 'asesor_tis':
                    $publicaciones = $this->getPublicacionesAsesor($user);
                    break;
                case 'estudiante':
                    $publicaciones = $this->getPublicacionesEstudiante($user);
                    break;
                default:
                    $semestre = Semestre::semestreActual();
                    $publicaciones = $this->getPublicacionesSemestre($semestre->id);
                    break;
            }
        }
        $publicaciones = $publicaciones->orderBy('fecha_publicacion','desc')->get();
        foreach($publicaciones as $publicacion)
        {
            $adjuntos = $this->getAdjuntos($publicacion);
            $publicacion['adjuntos'] = $adjuntos;
        }
        return $publicaciones;
    }

    public function getAllPublicaciones()
    {
        $publications=Publicacion::join('asesores','publicaciones.asesor_id','=','asesores.id')
        ->join('users','asesores.user_id','=','users.id')
        ->select('publicaciones.*','users.name','users.lastname')
        ->orderBy('fecha_publicacion');
        return $publications;
    }

    public function getPublicacionesSemestre($semestre_id)
    {
        $publications = Publicacion::join('asesores','publicaciones.asesor_id','=','asesores.id')
        ->join('users','asesores.user_id','=','users.id')
        ->join('publicacion_semestres','publicacion_semestres.publicacion_id','=','publicaciones.id')
        ->where('publicacion_semestres.semestre_id','=',$semestre_id)
        ->select('publicaciones.*','users.name','users.lastname');
        return $publications;
    }

    public function getPublicacionesGrupo($grupo_id)
    {
        $publications = Publicacion::join('asesores','publicaciones.asesor_id','=','asesores.id')
        ->join('users','asesores.user_id','=','users.id')
        ->join('publicacion_grupos','publicacion_grupos.publicacion_id','=','publicaciones.id')
        ->where('publicacion_grupos.grupo_id','=',$grupo_id)
        ->select('publicaciones.*','users.name','users.lastname');
        return $publications;
    }

    public function getPublicacionesGE($ge_id)
    {
        $publications = Publicacion::join('asesores','publicaciones.asesor_id','=','asesores.id')
        ->join('users','asesores.user_id','=','users.id')
        ->join('publicacion_grupoempresas','publicacion_grupoempresas.publicacion_id','=','publicaciones.id')
        ->where('publicacion_grupoempresas.grupoempresa_id','=',$ge_id)
        ->select('publicaciones.*','users.name','users.lastname');
        return $publications;
    }

    public function getPublicacionesAsesor($user)
    {
        $asesor = $user->asesor()->first();
        $publications = Publicacion::join('asesores','publicaciones.asesor_id','=','asesores.id')
        ->join('users','asesores.user_id','=','users.id')
        ->join('publicacion_semestres','publicaciones.id','=','publicacion_semestres.publicacion_id')
        ->select('publicaciones.*','users.name','users.lastname');

        $grupos = $asesor->grupos()->get();
        foreach($grupos as $grupo)
        {
            $publications_grupo = $this->getPublicacionesGrupo($grupo->id);
            $publications = $publications->union($publications_grupo);
            $grupoempresas = $grupo->grupoempresas()->get();
            foreach($grupoempresas as $ge)
            {
                $publications_ge = $this->getPublicacionesGE($ge->id);
                $publications = $publications->union($publications_ge);
            }
        }

        return $publications;
    }

    public function getPublicacionesEstudiante($user)
    {
        $semestre = $this->semestreActual();
        $publicaciones = $this->getPublicacionesSemestre($semestre->id);
        
        $estudiante = $user->estudiante()->first();
        $grupo = $estudiante->grupo()->first();
        $publicaciones_grupo = $this->getPublicacionesGrupo($grupo->id);
        $publicaciones = $publicaciones->union($publicaciones_grupo);

        $ge = $estudiante->grupoempresa()->first();
        if($ge != null)
        {
            $publicaciones_ge = $this->getPublicacionesGE($ge->id);
            $publicaciones = $publicaciones->union($publicaciones_ge);
        }
        return $publicaciones;
    }

    public function getAdjuntos($publicacion)
    {
        $adjuntos = Adjunto_publicacion::where('publicacion_id','=',$publicacion->id)
        ->join('adjuntos','adjuntos.id','=','adjunto_publicaciones.adjunto_id');
        return $adjuntos->get();
    }
    public function semestreActual()
    {
        $currentDate = date('Y-m-d');
        $semestre = Semestre::where('fecha_inicio','<=',$currentDate)
                    ->where('fecha_fin','>=',$currentDate)->first();
        return $semestre;
    }

}
