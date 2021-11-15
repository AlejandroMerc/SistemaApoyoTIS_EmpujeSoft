<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateActivityController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showCreateActivity (){
        return view ('createActivity');
    }
}
