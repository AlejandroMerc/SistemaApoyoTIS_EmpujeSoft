<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Grupoempresa;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ActivitySendCorrectionController extends Controller
{

    public function index($id_grupoempresa, $id_activity)
    {
        $user_type = Session::get('type');
        $user_id = Session::get('id');
        $title = $this->title($user_id, $user_type);

        $grupoempresa = Grupoempresa::find($id_grupoempresa)->nombre_largo;
        $activity = Publicacion::find($id_activity)->titulo_publicacion;

        return view('activityCorrected',[
            'id_grupoempresa' =>  $id_grupoempresa,
            'grupoempresa' => $grupoempresa,
            'id_activity'=> $id_activity,
            'activity' => $activity,
            'user_type' => $user_type,
            'title' => $title
        ]);
    }

    public function sendActivity($id_grupoempresa, $id_activity) {

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


}
