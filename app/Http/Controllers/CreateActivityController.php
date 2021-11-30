<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Asesor;
use App\Models\Publicacion;
use App\Models\Grupo;
use App\Models\Publicacion_asignada_grupo;
use App\Models\Publicacion_asignada_grupoempresa;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CreateActivityController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showCreateActivity (){
        $asesor = $this->getAsesor();
        $grupos=$asesor->grupos()->select('id','sigla_grupo')->get();
        $grupoEmpresas=$asesor->grupoempresas()->select('id','nombre_corto')->get();
        return view ('createActivity',compact('grupos'),compact('grupoEmpresas'));
    }

    public function registerActivityData(Request $request){
        $request->validate([
            'title' => ['required', 'string', 'max:50','regex:/^[a-zA-Z0-9_ ]*$/'],
            'description'=>['required','string','max:350'],    
            'uploadFiles'=>'mimetypes:image/jpeg,image/png,image/gif,image/bmp,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,pplication/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'deathline'=>['required','date'],
            'cantFilesMax'=>['required','numeric','min:1','max:10']
        ]);
        $asesor = $this->getAsesor();
        $publication = new Publicacion;
        $publication->titulo_publicacion=$request->title;
        $currentTime=Carbon::now();
        $publication->fecha_publicacion=$currentTime->toDateTimeString();
        $publication->descripcion_publicacion=$request->description;
        $idAdviser = $asesor->id;
        $publication->asesor_id=$idAdviser;

        $added=$publication->save();
        
        if($request->toWhom=="everybody"){
            $gruposTodos=Grupo::select('id')->get();
            foreach($gruposTodos as $grupo){
                $publiGroup=new Publicacion_asignada_grupo;
                $publiGroup->publicacion_id=$publication->id;
                $publiGroup->grupo_id=$grupo->id;
                $added2=$publiGroup->save();
            }
        }
        else
        {
            
            $toWhoms=explode(", ",$request->toWhom );
            $tipo = $toWhoms[0];
            $id = $toWhoms[1];
            
            if($tipo == 'grupo')
            {
                $publiGroup=new Publicacion_asignada_grupo;
                $publiGroup->publicacion_id=$publication->id;
                $publiGroup->grupo_id=$id;
                $added2=$publiGroup->save();
            }
            else
            {
                $publiGroup=new Publicacion_asignada_grupoempresa;
                $publiGroup->publicacion_id=$publication->id;
                $publiGroup->grupo_id=$id;
                $added2=$publiGroup->save();
            }
        }

        $activity=new Actividad;
        $activity->fecha_inicio_actividad=$currentTime->toDateTimeString();
        $activity->fecha_fin_actividad=$request->deathline;
        $activity->cantidad_archivos_perm=$request->cantFilesMax;
        $activity->tipo_archivos_perm=$request->typeFiles;
        $activity->publicacion_id=$publication->id;
        $added3=$activity->save();

        if($added && $added3){
            return redirect('home');
        }
    }
    public function getAsesor(){
        $idAdviser = Session::get('id');
        $user = User::find($idAdviser);
        $asesor=$user->asesor()->first();
        return $asesor;
    }
}
