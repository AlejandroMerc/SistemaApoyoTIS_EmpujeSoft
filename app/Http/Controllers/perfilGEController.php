<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Estudiante;
use App\Models\Grupoempresa;

use Illuminate\Http\Request;

class perfilGEController extends Controller
{
    //
    public function index(){
        $user_type = Session::get('type');
        $id = Session::get('id');

        $title = 'Asesor';
        if($user_type == 'estudiante')
        {
            $row = Estudiante::where('user_id',$id)->first();
            $ge_id = $row->grupoempresa_id;
            if($ge_id == null)
            {
                $title = '[Sin grupo empresa]';
            }
            else
            {
                $row = Grupoempresa::where('id',$ge_id)->first();
                $title = $row->nombre_largo;
            }
        }
        return view('perfilGE');
        return view('crearGrupo',['user_type' => $user_type, 'title' => $title]);
    }
}
