<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Grupoempresa;
use App\Models\Plantilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TemplateEditorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function index()
    // {
    //     $user_type = Session::get('type');
    //     $id = Session::get('id');

    //     $title = 'Asesor';
    //     if($user_type == 'estudiante')
    //     {
    //         $row = Estudiante::where('user_id',$id)->first();
    //         $ge_id = $row->grupoempresa_id;
    //         if($ge_id == null)
    //         {
    //             $title = '[Sin grupo empresa]';
    //         }
    //         else
    //         {
    //             $row = Grupoempresa::where('id',$ge_id)->first();
    //             $title = $row->nombre_largo;
    //         }
    //     }
    //     $doc = '';
    //     $name = '';
    //     return view('templateeditor',['user_type' => $user_type, 'title' => $title, 'name' => $name, 'dochtml' => $doc]);
    // }

    public function index($id)
    {
        $user_type = Session::get('type');
        $user_id = Session::get('id');

        $title = 'Asesor';
        if($user_type == 'estudiante')
        {
            $row = Estudiante::where('user_id', $user_id)->first();
            $ge_id = $row->grupoempresa_id;
            if($ge_id == null)
            {
                $title = '[Sin grupo empresa]';
            }
            else
            {
                $row = Grupoempresa::where('id', $ge_id)->first();
                $title = $row->nombre_largo;
            }
        }
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

    public function save($id, Request $request)
    {
        if ($request->editor === null) {
            $request->editor = "";
        }
        if ($request->name === null) {
            return 'nombre vacio';
        }

        if ($id === '-1')
        {
            $template = new Plantilla();
            if ($this->namerepeated($request->name))
            {
                return 'nombre repetido';
            }
            else
            {
                $template->nombre = $request->name;
                $template->html_code = $request->editor;
                $template->save();
            }
        }
        else
        {
            $template = Plantilla::find($id);
            $oldname = $template->nombre;
            if ( $request->name === $oldname)
            {
                $template->html_code = $request->editor;
                $template->save();
            }
            else{
                if ($this->namerepeated($request->name))
                {
                    return 'nombre repetido';
                }
                else
                {
                    $template->nombre = $request->name;
                    $template->html_code = $request->editor;
                    $template->save();
                }
            }
        }
        return redirect(route('template'));
    }

    private function namerepeated($name) {
        return Plantilla::where('nombre', $name)->count() > 0;
    }
}
