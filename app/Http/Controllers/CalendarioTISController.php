<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarioTISController extends Controller
{
    //
    public function showCreateEventTIS(){
        return view('calendarioTIS');
      } 
    public function createEventTIS(Request $request){
        $request->validate([
          'name' => ['required', 'string', 'max:50','regex:/^[\pL\s\-]+$/u'],
          'description'=>['required','string','max:350'],    
          'deathline'=>['required','date']
      ]);
      }
}
