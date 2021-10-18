<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
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
            'email' => ['required', 'string', 'email', 'max:255', /* 'unique:users' */],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'code'=>['required','numeric'],
        ]);

        return redirect('login')->withSuccess("You have signed in");
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'lastname'=>$data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'code'=> $data['code'],
        ]);
    }
}
