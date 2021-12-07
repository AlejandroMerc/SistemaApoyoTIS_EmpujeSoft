<?php

namespace App\Http\Controllers;
use App\Models\Grupo;
use App\Models\Grupoempresa;
use App\Models\Publicacion;
use App\Models\Publicacion_grupo;
use App\Models\Publicacion_grupoempresa;
use App\Models\Publicacion_semestre;
use App\Models\Semestre;

use Illuminate\Http\Request;

class VerRespuestasDosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function verRespuestasDos($publicacion_id){
        $asignados = $this->getAsignados($publicacion_id);
        return view('verRespuestas2', ['id' => $publicacion_id], compact('asignados'));
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
}
