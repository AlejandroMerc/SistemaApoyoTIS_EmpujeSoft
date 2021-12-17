<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanificacionCrearEventoController extends Controller
{
  public function showCreateEvent(){
    return view('planificacion_crear_evento');
  } 
  public function createEvent(Request $request){
    $request->validate([
      'name' => ['required', 'string', 'max:50','regex:/^[\pL\s\-]+$/u'],
      'description'=>['required','string','max:350'],    
      'deathline'=>['required','date']
  ]);
  }
}
