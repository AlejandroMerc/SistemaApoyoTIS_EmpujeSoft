<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
        $template_content = $this->arrayTemplate();

        return view('activityCorrected',[
            'id_grupoempresa' =>  $id_grupoempresa,
            'grupoempresa' => $grupoempresa,
            'id_activity'=> $id_activity,
            'activity' => $activity,
            'user_type' => $user_type,
            'title' => $title,
            'template_content' => $template_content
        ]);
    }

    public function sendActivity($id_grupoempresa, $id_activity, Request $request) {

        $this->createPdfFromHtml('');
        return 'fin';

        $request->validate([
            'title' => ['required', 'string', 'max:50','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'description'=>['required','string','max:350'],
            'filenames.*' => 'mimes:jpeg,gif,bmp,doc,pdf,docx,xls,xlsx,ppt,pptx,zip,rar',
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
            $publiSemestre = new Publicacion_semestre();
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
                $publiGroup=new Publicacion_grupo();
                $publiGroup->publicacion_id=$publication->id;
                $publiGroup->grupo_id=$id;
                $added2=$publiGroup->save();
            }
            else
            {
                $publiGroup=new Publicacion_grupoempresa();
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

                $adjunto_publicacion = new Adjunto_publicacion();
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
        $activity=new Actividad();
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

    public function createPdfFromHtml($html_code) {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html_code);

        return $pdf->download('archivoprueba.pdf');
    }

    public function getAsesor(){
        $idAdviser = Session::get('id');
        $user = User::find($idAdviser);
        $asesor=$user->asesor()->first();
        return $asesor;
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
