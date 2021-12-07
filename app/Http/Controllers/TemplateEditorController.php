<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Grupoempresa;
use App\Models\Plantilla;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TemplateEditorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $user_type = Session::get('type');
        $user_id = Session::get('id');
        $title = $this->title($user_id, $user_type);

        if ($id === '-1')
        {
            $doc = '';
            $name = '';
        }
        else
        {
            $template = Plantilla::where('id', $id)->first();
            $doc = $template->html_code;
            $name = $template->nombre;
        }

        return view('templateeditor',['id' =>  $id, 'user_type' => $user_type, 'title' => $title, 'name' => $name, 'dochtml' => $doc]);
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

    public function save($id, Request $request)
    {
        if ($request->editor === null) {
            $request->editor = "";
        }

        if ($id === '-1')
        {
            $rules = ['name' => 'required|unique:plantillas,nombre'];
            $errormsg = [
                'unique' => 'Nombre ya existente',
                'required' => 'Nombre vacio'
            ];
            $this->validate($request, $rules, $errormsg);

            $template = new Plantilla();
            $template->nombre = $request->name;
            $template->html_code = $request->editor;
            $saved = $template->save();
            if ( !$saved ) {
                return redirect()->back()->with('alert', 'No se pudo guardar la plantilla\nVuelva a intentarlo en un momento.');
            }
        }
        else
        {
            $template = Plantilla::find($id);
            $oldname = $template->nombre;
            if ( $request->name === $oldname)
            {
                $template->html_code = $request->editor;
                $saved = $template->save();
                if ( !$saved ) {
                    return redirect()->back()->with('alert', 'No se pudo guardar la plantilla\nVuelva a intentarlo en un momento.');
                }
            }
            else{
                $rules = ['name' => 'required|unique:plantillas,nombre'];
                $errormsg = [
                    'unique' => 'Nombre ya existente',
                    'required' => 'Nombre vacio'
                ];
                $this->validate($request, $rules, $errormsg);

                $template = new Plantilla();
                $template->nombre = $request->name;
                $template->html_code = $request->editor;
                $saved = $template->save();
                if ( !$saved ) {
                    return redirect()->back()->with('alert', 'No se pudo guardar la plantilla\nVuelva a intentarlo en un momento.');
                }
            }
        }
        return redirect(route('template'));
    }

    private function namerepeated($name) {
        return Plantilla::where('nombre', $name)->count() > 0;
    }
}
