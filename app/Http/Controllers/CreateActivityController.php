<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Adjunto;
use App\Models\Adjunto_publicacion;
use App\Models\Adjunto_entrega;
use App\Models\Asesor;
use App\Models\Publicacion;
use App\Models\Grupo;
use App\Models\Publicacion_grupo;
use App\Models\Publicacion_grupoempresa;
use App\Models\Publicacion_semestre;
use App\Models\Semestre;
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
        $grupoEmpresas = $asesor->grupos()->join('grupoempresas','grupos.id','=','grupoempresas.grupo_id')
                       ->select('grupoempresas.id','grupoempresas.nombre_corto')
                       ->get();
        return view ('createActivity',compact('grupos'),compact('grupoEmpresas'));
    }

    public function registerActivityData(Request $request){
        $request->validate([
            'title' => ['required', 'string', 'max:50','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
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
            $currentDate = date('Y-m-d');
            $semestre = Semestre::where('fecha_inicio','<=',$currentDate)
                        ->where('fecha_fin','>=',$currentDate)->first();
            $publiSemestre = new Publicacion_semestre;
            $publiSemestre->publicacion_id = $publication->id;
            $publiSemestre->semestre_id = $semestre->id;
            $added2=$publiSemestre->save();
        }
        else
        {
            
            $toWhoms=explode(", ",$request->toWhom );
            $tipo = $toWhoms[0];
            $id = $toWhoms[1];
            
            if($tipo == 'grupo')
            {
                $publiGroup=new Publicacion_grupo;
                $publiGroup->publicacion_id=$publication->id;
                $publiGroup->grupo_id=$id;
                $added2=$publiGroup->save();
            }
            else
            {
                $publiGroup=new Publicacion_grupoempresa;
                $publiGroup->publicacion_id=$publication->id;
                $publiGroup->grupoempresa_id=$id;
                $added2=$publiGroup->save();
            }
        }
        $files = [];
        if($request->hasfile('filenames'))
         {
            foreach($request->file('filenames') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $files[] = $name;  
                $adjunto = $this->saveFiles($file);
                $added3 = $adjunto->save();

                $adjunto_publicacion = new Adjunto_publicacion;
                $adjunto_publicacion->publicacion_id = $publication->id;
                $adjunto_publicacion->adjunto_id = $adjunto->id;
                $added4 = $adjunto_publicacion->save();
            }
         }
/*
        if($request->uploadFiles != null)
        { 
            $adjunto = $this->saveFiles($request->uploadFiles);
            $added3 = $adjunto->save();

            $adjunto_publicacion = new Adjunto_publicacion;
            $adjunto_publicacion->publicacion_id = $publication->id;
            $adjunto_publicacion->adjunto_id = $adjunto->id;
            $added4 = $adjunto_publicacion->save();
        }
*/
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

    public function saveFiles($uploadFiles)
    {
        $adjunto = new Adjunto;
        $adjunto->name = $uploadFiles->getClientOriginalName();
        $adjunto->path = $uploadFiles->store('files');
        return $adjunto;
    }
}
