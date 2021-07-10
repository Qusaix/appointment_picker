<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials))
        {
            return redirect()->route('dashboard');
        }
        else
        {
            return 'please enter the right cred';
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
