<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateSemesterController extends Controller
{
    public function createSemester(){
        return view('createSemester');
    }
}
