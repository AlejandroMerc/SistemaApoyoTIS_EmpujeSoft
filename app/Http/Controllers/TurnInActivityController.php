<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Adjunto_publicacion;
use App\Models\Adjunto;
use App\Models\Adjunto_entrega;
use App\Models\Entrega;
use App\Models\Estudiante;
use App\Models\Grupoempresa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class TurnInActivityController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showTurnIn($publicacion_id){
        $user_type = Session::get('type');
        $idUser=Session::get('id');
        $title = $this->title($idUser, $user_type);


        $user = User::find($idUser);
        $estudiante=$user->estudiante()->first();
        if($estudiante->grupoempresa_id == null)
        {
            return redirect()->back();
        }

        $entregado=false;
        $actividad=Actividad::where('publicacion_id','=',$publicacion_id)->first();

        $hayEntregado=Entrega::where('actividad_id','=',$actividad->id)->where('grupoempresa_id','=',$estudiante->grupoempresa_id)->first();
        if($hayEntregado!=null){
            $entregado=true;
            $adjuntosEntrega=Entrega::where('actividad_id','=',$actividad->id)
                                ->join('adjunto_entregas','entrega_id','=','entregas.id')
                                ->join('adjuntos','adjuntos.id','=','adjunto_entregas.adjunto_id')->get();
            $hayEntregado['adjuntosEntrega']=$adjuntosEntrega;
        }

        if($actividad->tipo_archivos_perm=="docs"){
            $actividad->tipo_archivos_perm="Documentos (pdf, docx, txt, pptx, xlsx)";
        }else{
            if($actividad->tipo_archivos_perm=="images"){
                $actividad->tipo_archivos_perm="Imágenes (jpg, jpge, png, gif, bpm)";
            }else{
                if($actividad->tipo_archivos_perm=="compress"){
                    $actividad->tipo_archivos_perm="Comprimidos (zip, rar)";
                }else{
                    if($actividad->tipo_archivos_perm=="anything"){
                        Log::info("entre");
                        $actividad->tipo_archivos_perm="Cualquiera";
                    }

                }
            }
        }

        $publicacion_a_Responder=Publicacion::where('id','=',$publicacion_id)->first();
        $adjuntos = $this->getAdjuntos($publicacion_a_Responder);
            $publicacion_a_Responder['adjuntos'] = $adjuntos;

        return view('TurnInActivity',['user_type' => $user_type, 'title' => $title])
        ->with( compact('actividad'))
        ->with(compact ('publicacion_a_Responder','hayEntregado'));
    }

    public function validateFiles(Request $request){
        $file = $request->file('file');

        $fileName = time().'.'.$file->extension();

        Log::info(gettype($file));
        $adjunto = $this->saveFiles($file);
        $addedAdjunto = $adjunto->save();

        $idUser=Session::get('id');
        $user = User::find($idUser);
        $estudiante=$user->estudiante()->first();



        $entrega=new Entrega;
        $currentTime=Carbon::now();
        $entrega->fecha_entrega=$currentTime->toDateTimeString();
        $entrega->actividad_id=$request->idActividad;
        $entrega->grupoempresa_id=$estudiante->grupoempresa_id;
        $addedEntrega=$entrega->save();

        $adjunto_entrega = new Adjunto_entrega;
        $adjunto_entrega->entrega_id=$entrega->id;
        $adjunto_entrega->adjunto_id = $adjunto->id;
        $addedAdjuntoEntrega = $adjunto_entrega->save();


        return response()->json(['success'=>$fileName]);
    }

    public function getAdjuntos($publicacion)
    {
        $adjuntos = Adjunto_publicacion::where('publicacion_id','=',$publicacion->id)
        ->join('adjuntos','adjuntos.id','=','adjunto_publicaciones.adjunto_id');
        return $adjuntos->get();
    }

    public function saveFiles($uploadFile)
    {
        $adjunto = new Adjunto;
        $adjunto->name = $uploadFile->getClientOriginalName();
        $adjunto->path = $uploadFile->store('files');
        return $adjunto;
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
