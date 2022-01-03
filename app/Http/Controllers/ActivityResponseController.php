<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Grupoempresa;
use App\Models\Plantilla;
use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ActivityResponseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexResponse($id_grupoempresa, $id_activity)
    {
        $user_type = Session::get('type');
        $user_id = Session::get('id');
        $title = $this->title($user_id, $user_type);

        $grupoempresa = Grupoempresa::find($id_grupoempresa)->nombre_largo;
        $activity = Publicacion::find($id_activity)->titulo_publicacion;
        $template_content = $this->arrayTemplate();

        return view('activityResponse',[
            'grupoempresa' =>  $grupoempresa,
            'id_grupoempresa'=>$id_grupoempresa,
            'id_activity' => $id_activity,
            'activity' => $activity,
            'user_type' => $user_type,
            'title' => $title,
            'template_content' => $template_content
        ]);
    }

    public function response($id_grupoempresa, $id_activity, Request $request) {
        if ( $request->has('save') ) // Seleccionó guardado
        {
            if ($request->has('cbxEditor'))
            {
                return "guardando con editor seleccionado";
            }
            else
            {
                return "guardando con archivo seleccionado";
            }
        }
        else // Seleccionó enviar
        {
            if ($request->has('cbxEditor'))
            {
                $rules = ['editor' => 'required'];
                $errormsg = [
                    'required' => 'El contenido está vacio'
                ];
                $this->validate($request, $rules, $errormsg);
                /*

                GUARDAR EN BASE DE DATOS


                */
            }
            else
            {
                $rules = ['file' => 'required'];
                $errormsg = [
                    'required' => 'Debe subir un archivo'
                ];
                $this->validate($request, $rules, $errormsg);
                /*

                GUARDAR EN BASE DE DATOS


                */
            }
        }
        return redirect(route('verRespuesta.correccion',['id_grupoempresa'=>$id_grupoempresa, 'id_activity'=>$id_activity]));
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
