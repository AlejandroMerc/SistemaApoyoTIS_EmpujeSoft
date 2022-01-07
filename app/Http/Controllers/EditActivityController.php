<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Adjunto;
use App\Models\Adjunto_publicacion;
use App\Models\Estudiante;
use App\Models\Grupoempresa;
use App\Models\Plantilla;
use App\Models\Publicacion;
use App\Models\Publicacion_grupo;
use App\Models\Publicacion_grupoempresa;
use App\Models\Publicacion_semestre;
use App\Models\Semestre;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class EditActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ($idPost){
        
        $user_type = Session::get('type');
        $user_id = Session::get('id');
        $title = $this->title($user_id, $user_type);

        $asesor = $this->getAsesor();
        $grupos=$asesor->grupos()->select('id','sigla_grupo')->get();
        $grupoEmpresas = $asesor->grupos()->join('grupoempresas','grupos.id','=','grupoempresas.grupo_id')
                       ->select('grupoempresas.id','grupoempresas.nombre_corto')
                       ->get();
        $template_content = $this->arrayTemplate();

        $publication=Publicacion::where('id',$idPost)->first();
        $activity=Actividad::where('publicacion_id',$idPost)->first();
        $adjuntos = $this->getAdjuntos($publication);
        $publication['adjuntos']=$adjuntos;
       
        return view ('editActivity',['user_type' => $user_type, 'title' => $title,'template_content'=>$template_content])
            -> with(compact('grupos'))
            -> with(compact('grupoEmpresas'))
            -> with(compact('publication'))
            -> with(compact('activity'));
    }

    public function updateActivity (Request $request){
        
        $request->validate([
            'title' => ['required', 'string', 'max:50','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'description'=>['required','string','max:350'],
            'filenames.*' => 'mimes:jpeg,gif,bmp,doc,pdf,docx,xls,xlsx,ppt,pptx,zip,rar',

        ]);
        $asesor = $this->getAsesor();
        $publication=Publicacion::where('id',$request->idPost)->first();
        $publication->titulo_publicacion=$request->title;
        $publication->descripcion_publicacion=$request->description;
        $currentTime=Carbon::now();
        $publication->fecha_publicacion=$currentTime->toDateTimeString();
        $idAdviser = $asesor->id;
        $publication->asesor_id=$idAdviser;
       
        $publication->save();

        //Borramos los existentes
        $publicacionSemestre=Publicacion_semestre::where('publicacion_id',$request->idPost)->first();
        if($publicacionSemestre!=null){
            $publicacionSemestre->delete();
        }
        $publicacionGrupo=Publicacion_grupo::where('publicacion_id',$request->idPost)->first();
        if($publicacionGrupo!=null){
            $publicacionGrupo->delete();
        }
        $publicacionesGE=Publicacion_grupoempresa::where('publicacion_id',$request->idPost)->first();
        if($publicacionesGE!=null){
            $publicacionesGE->delete();
        }
//Agregamos
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
      
        //Borramos los adjuntos editados
        
        if(!empty($request->adjuntos)){
           
            $idAdjuntos=[];
            foreach($request->adjuntos as $adj){
                $adjuntoEdit=Adjunto::where('id',$adj)->first();
                $idAdjuntos[]=$adjuntoEdit->id;
            }
            $adjuntosExistentes=Adjunto_publicacion::where('publicacion_id',$request->idPost)->get();
            foreach($adjuntosExistentes as $adjuntoEx){
                if(!in_array($adjuntoEx->adjunto_id,$idAdjuntos)){
                    $adjuntoOr=Adjunto::where('id','=',$adjuntoEx->adjunto_id)->first();
                    Log::info('llegue');
                    Log::info($adjuntoOr);
                    $adjuntoOr->delete();
                    $adjuntoEx->delete();
                    
                }
            }
        }else{
            $adjuntosExistentes=Adjunto_publicacion::where('publicacion_id',$request->idPost)->get();
            foreach($adjuntosExistentes as $adjuntoEx){
                     $adjuntoOr=Adjunto::where('id','=',$adjuntoEx->adjunto_id)->first();
                     $adjuntoOr->delete();
                    $adjuntoEx->delete();
                
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
         if ( $request->has('cbxEditor') )
         {
             $name = time().rand(1,100).'.pdf';
             $path = 'files/'.$name;
 
             $this->createPdfFromHtml($request->editor, $path);
 
             $adjunto = $this->createAdjuntoEditor('documento', $path);
             $added3 = $adjunto->save();
 
             $adjunto_publicacion = new Adjunto_publicacion();
             $adjunto_publicacion->publicacion_id = $publication->id;
             $adjunto_publicacion->adjunto_id = $adjunto->id;
             $added4 = $adjunto_publicacion->save();
         }

        $activity=Actividad::where('id',$request->idActivity)->first();
        $activity->fecha_inicio_actividad=$currentTime->toDateTimeString();
        $activity->fecha_fin_actividad=$request->deathline;
        $activity->cantidad_archivos_perm=$request->cantFilesMax;
        $activity->tipo_archivos_perm=$request->typeFiles;
        $activity->publicacion_id=$publication->id;
        $added3=$activity->save();
        return redirect('home');
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

    public function createAdjuntoEditor($name, $path) {
        $adjunto = new Adjunto();
        $adjunto->name = $name;
        $adjunto->path = $path;
        return $adjunto;
    }

    public function createPdfFromHtml($html_code, $path) {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html_code);

        $content = $pdf->download()->getOriginalContent();
        Storage::put($path, $content);
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

    public function getAdjuntos($publicacion)
    {
        $adjuntos = Adjunto_publicacion::where('publicacion_id','=',$publicacion->id)
        ->join('adjuntos','adjuntos.id','=','adjunto_publicaciones.adjunto_id');
        return $adjuntos->get();
    }
    public function saveFiles($uploadFiles)
    {
        $adjunto = new Adjunto;
        $adjunto->name = $uploadFiles->getClientOriginalName();
        $adjunto->path = $uploadFiles->store('files');
        return $adjunto;
    }
    public function getAsesor(){
        $idAdviser = Session::get('id');
        $user = User::find($idAdviser);
        $asesor=$user->asesor()->first();
        return $asesor;
    }

}
