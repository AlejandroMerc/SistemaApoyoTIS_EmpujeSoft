<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Adjunto_publicacion;

class TurnInActivityController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showTurnIn($publicacion_id){
        Log::info($publicacion_id);
        $actividad=Actividad::where('publicacion_id','=',$publicacion_id)->first();
        Log::info($actividad->tipo_archivos_perm);
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
        Log::info($publicacion_a_Responder->id);
        return view('TurnInActivity', compact('actividad'),compact ('publicacion_a_Responder'));
    }

    public function sendActivity(Request $request){
        $image = $request->file('file');
    
        $imageName = time().'.'.$image->extension();
        //$image->move(public_path('images'),$imageName);
    
        return response()->json(['success'=>$imageName]);
    }

    public function getAdjuntos($publicacion)
    {
        $adjuntos = Adjunto_publicacion::where('publicacion_id','=',$publicacion->id)
        ->join('adjuntos','adjuntos.id','=','adjunto_publicaciones.adjunto_id');
        return $adjuntos->get();
    }
}
