<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateSemesterController extends Controller
{
    public function createSemester(){
        return view('createSemester');
    }
    public function createSemesterData(Request $request){
        $request->validate([
            'anio' => ['required', 'numeric'],
            'periodo'=>['required','numeric'],    
            'fechaIni'=>['required','date'],
            'fechaFin'=>['required','date']
        ]);
    }
}
