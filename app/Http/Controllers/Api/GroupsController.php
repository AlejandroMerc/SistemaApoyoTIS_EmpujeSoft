<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Models\Grupo;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function getGroup($group_id) {
        $group = Grupo::find($group_id);
        return response()->json($group,200);
    }

    public function deleteGroup($group_id) {
        $estudiantes_grupo = Estudiante::where('grupo_id',$group_id)->get();
        $grupo_vacio = $estudiantes_grupo->isEmpty();
        if ( $grupo_vacio ) {
            $group = Grupo::find($group_id);
            $group->delete();
        }
        $array = [];
        $array['value'] = $grupo_vacio;
        return response()->json($array, 200);
    }
}
