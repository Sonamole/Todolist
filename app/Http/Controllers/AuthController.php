<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Session;

use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function index()
    {
        return view('todo.authe.login');
    }

    public function Login(Request $request)
{
    $validator = $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $userId = Auth::user()->id;
        session(['user_id' => $userId]);
        return redirect()->route('list');
    }

    $validator['emailPassword'] = 'Email address or password is incorrect.';
    return redirect()->route('auth_login')->withErrors($validator);
}



    public function registration()
    {
        return view('todo.authe.register');
    }
    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>$data['password'],
        ]);

        return redirect()->route('auth_login')->withSuccess('You have signed up successfully. Please log in.');
    }


    public function signout()
    {
        Auth::logout();
        return redirect()->route('auth_login');  
    }

}


