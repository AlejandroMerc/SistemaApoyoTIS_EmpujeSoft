<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class CalendarioEventoController extends Controller
{
    public function index(){
        return view('evento.index');
    }

    public function store(Request $request){
        request()->validate(Evento::$rules);
        $evento = Evento::create($request->all());
    }
    public function show(Evento $evento){
        $evento = Evento::all();
        return response()->json($evento);
    }
}
