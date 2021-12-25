<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TurnInActivityController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showTurnIn(){
        return view('TurnInActivity');
    }

    public function sendActivity(Request $request){
        $image = $request->file('file');
    
        $imageName = time().'.'.$image->extension();
        //$image->move(public_path('images'),$imageName);
    
        return response()->json(['success'=>$imageName]);
    }
}
