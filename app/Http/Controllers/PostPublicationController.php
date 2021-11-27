<?php

namespace App\Http\Controllers;

use App\Models\Asesor;
use App\Models\Publicacion;
use App\Models\Publicacion_asignada_grupo;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostPublicationController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showPostPublication (){
        $idAdviser = Session::get('id');
        $asesor=Asesor::find($idAdviser);
        $grupos=$asesor->grupos()->select('id','sigla_grupo')->get();
        $grupoEmpresas=$asesor->grupoempresas()->select('id','nombre_corto')->get();
        return view ('postPublication',compact('grupos'),compact('grupoEmpresas'));
    }
    public function registerPublicationData(Request $request){
        $request->validate([
            'title' => ['required', 'string', 'max:50','regex:/^[a-zA-Z0-9_ ]*$/'],
            'description'=>['required','string','max:350'],    
            'uploadFiles'=>'mimetypes:image/jpeg,image/png,image/gif,image/bmp,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,pplication/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation',
        ]);
        $publication = new Publicacion;
        $publication->titulo_publicacion=$request->title;
        $currentTime=Carbon::now();
        $publication->fecha_publicacion=$currentTime->toDateTimeString();
        $publication->descripcion_publicacion=$request->description;
        $idAdviser = Session::get('id');
        $publication->asesor_id=$idAdviser;

        $added=$publication->save();
        
        if($request->toWhom=="onlyGroup"){
            $publiGroup=new Publicacion_asignada_grupo;
            $publiGroup->publicacion_id=$publication->id;
            $publiGroup->grupo_id=1;
            $added2=$publiGroup->save();
        }

        if($added){
            return redirect('home');
        }
    }
}
