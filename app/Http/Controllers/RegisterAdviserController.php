<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Asesor;
use App\Rules\checkCodigoAsesor;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterAdviserController extends Controller
{

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::LOGIN;

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    public function index ()
    {
        return view('auth.registerAdviser');
    }

    public function registerData(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50','regex:/^[\pL\s\-]+$/u'],
            'lastname'=>['required','string','max:50','regex:/^[\pL\s\-]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'code'=>['required','string', new checkCodigoAsesor()],
        ]);
        
        $user = new User;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->rol = 'asesor_tis';
        $query1 = $user->save();

        $asesor = new Asesor;
        $asesor->user_id = $user->id;
        $query2 = $asesor->save();
        
        if($query1 && $query2){
            return redirect('login')->withSuccess('Usuario Registrado');
        }
        else{
            return redirect('login')->withFailure('Usuario no registrado');
        }
    }
}
