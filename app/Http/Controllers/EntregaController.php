<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Entrega;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    public function getFiles($activity_id, $grupoempresa_id) {
        $id_activity = Actividad::where('publicacion_id',$activity_id)->first();
        $adjunto_entregas = Entrega::where('actividad_id',$id_activity->id)
                    -> where('grupoempresa_id',$grupoempresa_id)
                    ->join('adjunto_entregas','entrega_id','=','entregas.id')
                    ->join('adjuntos','adjuntos.id','=','adjunto_entregas.adjunto_id')->get();
        return response()->json($adjunto_entregas, 200);
    }
}
