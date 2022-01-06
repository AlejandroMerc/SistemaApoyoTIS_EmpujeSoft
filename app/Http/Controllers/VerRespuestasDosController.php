<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\Grupoempresa;
use App\Models\Publicacion;
use App\Models\Publicacion_grupo;
use App\Models\Publicacion_grupoempresa;
use App\Models\Publicacion_semestre;
use App\Models\Revision;
use App\Models\Semestre;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerRespuestasDosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function verRespuestasDos($publicacion_id){
        $user_type = Session::get('type');
        $id = Session::get('id');
        $title = $this->title($id, $user_type);

        $asignados = $this->getAsignados($publicacion_id);
        foreach($asignados as $asignado)
        {
            $actividad_id = Actividad::where('publicacion_id',$publicacion_id)->first()->id;
            $revision = Revision::where('grupoempresa_id','=',$asignado->id)
            ->where('actividad_id','=',$actividad_id)->first();
            if($revision == null)
            {
                $asignado['estado'] = 'No revisado';
            }
            else
            {
                $asignado['estado'] = $revision->estado;
            }
        }
        $fecha_limite = Actividad::where('publicacion_id',$publicacion_id)->first()->fecha_fin_actividad;
        return view('verRespuestas2', ['user_type' => $user_type, 'title' => $title, 'id' => $publicacion_id, 'fecha_limite'=>$fecha_limite], compact('asignados'));
    }

    public function getAsignados($publicacion_id)
    {
        $asignados = $this->getGruposAsignados($publicacion_id);
        return $asignados;
    }

    public function getGruposAsignados($publicacion_id)
    {
        $asignados;
        $pub_semestre = Publicacion_semestre::where('publicacion_id','=',$publicacion_id)->first();
        if($pub_semestre != null)
        {
            $asignados = Semestre::where('semestres.id','=',$pub_semestre->semestre_id)
            ->join('grupos','grupos.semestre_id','=','semestres.id')
            ->join('grupoempresas','grupoempresas.grupo_id','=','grupos.id')
            ->select('grupoempresas.id','grupoempresas.nombre_corto')
            ->get();
        }
        else
        {
            $pub_grupo = Publicacion_grupo::where('publicacion_id','=',$publicacion_id)->first();
            if($pub_grupo != null)
            {
                $asignados = Grupo::where('grupos.id','=',$pub_grupo->grupo_id)
                ->join('grupoempresas','grupoempresas.grupo_id','=','grupos.id')
                ->select('grupoempresas.id','grupoempresas.nombre_corto')
                ->get();
            }
            else
            {
                $pub_grupoempresa = Publicacion_grupoempresa::where('publicacion_id','=',$publicacion_id)->first();
                $asignados = Grupoempresa::where('grupoempresas.id','=',$pub_grupoempresa->grupoempresa_id)
                ->select('grupoempresas.id','grupoempresas.nombre_corto')
                ->get();
            }
        }
        return $asignados;
    }

    public function aceptar(Request $request)
    {
        $actividad = Actividad::where('actividades.publicacion_id','=',$request->actividad_id)->first();
        $revision = new Revision;
        $revision->actividad_id = $actividad->id;
        $revision->grupoempresa_id = $request->grupoempresa_id;
        $currentTime = Carbon::now();
        $revision->fecha_revision = $currentTime->toDateTimeString();
        $revision->estado = "Aceptado";
        $query = $revision->save();
        return $this->verRespuestasDos($request->actividad_id);
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
