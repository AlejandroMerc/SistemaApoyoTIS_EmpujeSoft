<?php

namespace App\Http\Controllers;

use App\Models\Adjunto_publicacion;
use App\Models\Estudiante;
use App\Models\Grupoempresa;
use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EditPostController extends Controller
{
    //
    public function index($idPost){
        
        $user_type = Session::get('type');
        $user_id = Session::get('id');
        $title = $this->title($user_id, $user_type);

        $publication=Publicacion::where('id',$idPost)->first();

        $asesor = $this->getAsesor();
        $grupos=$asesor->grupos()->select('id','sigla_grupo')->get();
        $grupoEmpresas = $asesor->grupos()->join('grupoempresas','grupos.id','=','grupoempresas.grupo_id')
                       ->select('grupoempresas.id','grupoempresas.nombre_corto')
                       ->get();

        $adjuntos = $this->getAdjuntos($publication);
        $publication['adjuntos']=$adjuntos;
        return view ('editPost',['user_type' => $user_type, 'title' => $title])
        ->with(compact('grupos'))
        ->with(compact('grupoEmpresas'))
        ->with(compact('publication'));
       
    }

    public function updatePost (Request $request){
        return $request;
    }

    public function getAdjuntos($publicacion)
    {
        $adjuntos = Adjunto_publicacion::where('publicacion_id','=',$publicacion->id)
        ->join('adjuntos','adjuntos.id','=','adjunto_publicaciones.adjunto_id');
        return $adjuntos->get();
    }

    public function getAsesor(){
        $idAdviser = Session::get('id');
        $user = User::find($idAdviser);
        $asesor=$user->asesor()->first();
        return $asesor;
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
