<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostPublicationController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showPostPublication (){
        return view ('postPublication');
    }
}
