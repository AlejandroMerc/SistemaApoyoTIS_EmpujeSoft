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
        return view('verRespuestas2');
    }

    public function getAsignados()
    {
        
    }
}
