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
    public function registerPublicationData(Request $request){
        $request->validate([
            'title' => ['required', 'string', 'max:50','regex:/^[a-zA-Z0-9_ ]*$/'],
            'description'=>['required','string','max:350'],    
            'uploadFiles'=>'mimetypes:image/jpeg,image/png,image/gif,image/bmp,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,pplication/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation',
        ]);
    }
}
