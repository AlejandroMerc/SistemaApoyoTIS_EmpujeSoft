<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostPublicationController extends Controller
{
    //
    public function showPostPublication (){
        return view ('postPublication');
    }
}
