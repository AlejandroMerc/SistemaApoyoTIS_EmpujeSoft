<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerRespuestasDosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function verRespuestasDos($publicacion_id){
        return view('verRespuestas2', ['id' => $publicacion_id]);
    }

    public function getAsignados($publicacion_id)
    {
        try 
        {
            $real_publicacion_id = Crypt::decryptString($publicacion_id);
            $publicacion = Publicacion::find($real_publicacion_id)->first();
        } 
        catch (DecryptException $e) 
        {
            //
        }
    }

    public function getGruposAsignados($publicacion_id)
    {
        $publicacion = Publicacion::find($publicacion_id)->first();
        $grupos = $publicacion->grupos_asignados()
                ->select('grupo_id')
                ->get();
    }
}
