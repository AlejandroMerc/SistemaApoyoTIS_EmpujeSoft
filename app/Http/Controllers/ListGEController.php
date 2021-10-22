<?php

namespace App\Http\Controllers;

use App\Models\grupoempresa;
use Illuminate\Http\Request;

class ListGEController extends Controller
{
    //
    public function showListGE()
    {
        $grupoEmpresas=grupoempresa::all();
        
        return view('listGE', compact('grupoEmpresas'));
    }
}
