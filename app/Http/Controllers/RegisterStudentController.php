<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterStudentController extends Controller
{
    public function index ()
    {
        return view('auth.registerStudent');
    }

    public function registerData(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'name' => ['required', 'string', 'max:2','alpha' ],
            'lastname'=>[],
            'email' => ['required', 'string', 'email', 'max:255', /* 'unique:users' */],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'code'=>[],
        ]);

        return redirect('login')->withSuccess("You have signed in");
    }

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
