<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerRespuestasDosController extends Controller
{
    public function verRespuestasDos($publicacion_id){
        return view('verRespuestas2');
    }

    public function getAsignados()
    {
        
    }
}
