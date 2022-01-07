<?php

namespace App\Http\Controllers;

use App\Models\Grupoempresa;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ListGEController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showListGE()
    {

        $user_type = Session::get('type');
        $user_id = Session::get('id');
        $title = $this->title($user_id, $user_type);

        $grupoEmpresas= Grupoempresa::join('estudiantes','estudiantes.id','grupoempresas.rep_legal_id')
        ->join('grupos','grupos.id','estudiantes.grupo_id')
        ->join('semestres','semestres.id','grupos.semestre_id')
        ->select('grupoempresas.id','grupoempresas.nombre_corto','grupoempresas.nombre_largo','semestres.year','semestres.periodo')
        ->get();

        $historico_ge = Grupoempresa::whereNull('grupo_id')->get();

        return view('listGE', ['user_type' => $user_type, 'title' => $title])
        ->with(compact('grupoEmpresas'))
        ->with(compact('historico_ge'));
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
                return 'Sin grupoempresa';
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
