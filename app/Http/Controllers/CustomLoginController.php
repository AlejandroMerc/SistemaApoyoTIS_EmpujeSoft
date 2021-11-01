<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CustomLoginController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials))
        {
            self::savesession($request);
            return redirect()->intended('home')
                        ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    protected function savesession(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email',$email)->first();
        $id = $user->id;

        $user_type = $user->rol;

        Session::put('id',$id);
        Session::put('type',$user_type);
    }
}
