<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
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

class VerRespuestasDosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function verRespuestasDos($publicacion_id){
        $asignados = $this->getAsignados($publicacion_id);
        foreach($asignados as $asignado)
        {
            $revision = Revision::where('grupoempresa_id','=',$asignado->id)->first();
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
        return view('verRespuestas2', ['id' => $publicacion_id, 'fecha_limite'=>$fecha_limite], compact('asignados'));
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
}
