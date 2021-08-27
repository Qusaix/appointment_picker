<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials,isset($request->remember_me)))
        {
            return redirect()->route('dashboard');
        }
        else
        {
            return back()->withErrors('please add the correct cred');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
