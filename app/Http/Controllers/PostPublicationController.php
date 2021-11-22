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
            'uploadFiles'=>'mimes:jpg,jpeg,gif,png,xls,xlsx,doc,docx,pdf',
        ]);
    }
}
