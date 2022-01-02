<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Carbon\Carbon;

class CalendarioEventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
    public function edit($id){
        $evento = Evento::find($id);
        $evento -> start = Carbon::createFromFormat('Y-m-d H:i:s',$evento -> start)->format('Y-m-d');
        $evento -> end = Carbon::createFromFormat('Y-m-d H:i:s',$evento -> end)->format('Y-m-d');
        return response()->json($evento);
    }
    public function destroy($id){
        $evento = Evento::find($id)->first();
        $evento->delete();
        return response()->json($evento);
        
    }
   
}
