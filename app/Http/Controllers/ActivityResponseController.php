<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Grupoempresa;
use App\Models\Plantilla;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ActivityResponseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($grupoempresa)
    {
        $user_type = Session::get('type');
        $user_id = Session::get('id');
        $title = $this->title($user_id, $user_type);

        $template_content = $this->arrayTemplate();

        return view('activityResponse',['grupoempresa' =>  $grupoempresa, 'user_type' => $user_type, 'title' => $title, 'template_content' => $template_content]);
    }

    public function response($grupoempresa) {

    }

    private function title($id, $rol){
        if ($rol === 'admin')
        {
            return 'Administrador';
        }
        else if ($rol === 'asesor_tis')
        {
            return 'Asesor TIS';
        }
        else if ($rol === 'estudiante')
        {
            $estudiante = Estudiante::where('user_id',$id)->first();
            $ge_id = $estudiante->grupoempresa_id;
            if ($ge_id === null)
            {
                return '[Sin grupo empresa]';
            }
            else
            {
                $ge = Grupoempresa::where('id',$ge_id)->first();
                return $ge->nombre_largo;
            }
        }
        else
        {
            return 'Invitado';
        }
    }

    private function arrayTemplate()
    {
        $templates = Plantilla::all();
        $myArray = array();
        foreach($templates as $template)
        {
            $myArray[$template->id] = $template->nombre;
        }
        return $myArray;
    }
}
