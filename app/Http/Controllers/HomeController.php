<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Asesor;
use App\Models\Estudiante;
use App\Models\Grupoempresa;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        Session::save();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_type = Session::get('type');
        $id = Session::get('id');

        $title = 'Asesor';
        if($user_type == 'estudiante') 
        {
            $row = Estudiante::where('user_id',$id)->first();
            $ge_id = $row->grupoempresa_id;
            if($ge_id == null)
            {
                $title = '[Sin grupo empresa]';
            }
            else 
            {
                $row = Grupoempresa::where('id',$ge_id)->first();
                $title = $row->nombre_largo;
            }
        }else{
            //$publi=new Publicacion;
            //$publications=$publi->get();
        }
       
        $publications=DB::table('publicacions')->join('users','publicacions.asesor_id','=','users.id')->select('publicacions.*','users.name','users.lastname')->get();
       
       
        foreach($publications as $pub ){
          
           $activities=Actividad::where('publicacion_id','=',$pub->id)->first();
           

           if(!empty($activities)){
           
            $pub->tipo="Actividad";  
            $pub->fechaDeEntrega=$activities->fecha_fin_actividad;
           }else{
            $pub->tipo="Publicación"; 
           }
             
        }
        return view('home',['user_type' => $user_type, 'title' => $title],compact('publications'));
    }

}
